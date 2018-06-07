<?php


/**
 * Get User Info
 * @return string
 */
function getUser()
{
    $user = '';
    if (Auth::guard('api')->user()) {
        $user = Auth::guard('api')->user();
    } elseif (Auth::guard('web')->user()) {
        $user = Auth::guard('web')->user();
    }
    return $user;
}

/**
 * Get Guest
 * @return string
 */
function getGuest()
{
    $guest = false;
    if (!Auth::guard('api')->guest()) {
        $guest = false;
    } elseif (!Auth::guest()) {
        $guest = false;
    }
    return $guest;
}

/**
 * Calc Width
 * @param $items
 * @return string
 */
function widthCalc($items)
{
    if ($items <= 2) {
        return 'width:200px;display:inline-table';
    } else {
        return 'width: ' . (100 / $items) . "%";
    }

}

/**
 * Set Division
 * @param $value1
 * @param $value2
 * @return float|int
 */
function division($value1, $value2)
{
    try {
        $result = $value1 / $value2;
    } catch (Exception $e) {
        $result = 0;
    }
    return $result;
}

/**
 * Calculate Days
 * @param $starts
 * @param $ends
 * @return int
 */
function taskDays($starts, $ends)
{
    $starts = new DateTime($starts);
    $ends = new DateTime($ends);
    $diff = $starts->diff($ends);
    return $diff->d;
}

/**
 * Task Type
 * @param $type
 * @return string
 */
function taskType($type)
{
    switch ($type) {
        case 1:
            return 'task';
            break;
        case 2:
            return 'plan';
            break;
        case 3:
            return 'test';
            break;
        default :
            return 'task';
    }
}

/**
 * File Name
 * @param string $type
 * @param null $extension
 * @return string
 */
function fileName($type = 'task', $extension = null)
{
    if ($extension == null) {
        return $type . '_' . str_random(15) . '_' . rand(10, 100);
    } else {
        return $type . '_' . str_random(15) . '_' . rand(10, 100) . '.' . $extension;
    }
}

/**
 * Get File Size
 * @param $size
 * @return float
 */
function taskFileSize($size)
{
    return round(($size / 1024), 2) . " KB";
}

/**
 * Money Format
 * @param $value
 * @return string
 */
function money($value)
{
    setlocale(LC_MONETARY, 'es_CO');
    return "$ " . number_format($value, 2, ',', '.');
}

/**
 * Percentage
 * @param $number
 * @param string $format
 * @param int $decimal
 * @return string
 */
function percentage($number, $format = 'discount', $decimal = 4)
{
    if ($format === 'discount') {
        return (1 - number_format($number, $decimal)) * 100 . '%';
    } else {
        return number_format($number, $decimal) * 100 . '%';
    }
}


/**
 * Get Subtotal
 * @param $details
 * @return int
 */
function subtotal($details)
{
    $subtotal = 0;
    foreach ($details as $detail) {
        $subtotal += $detail->total;
    }
    return $subtotal;
}

/**
 * Get Payment Pending
 * @param $payments
 * @return int
 */
function paymentPending($payments)
{
    $subtotal = 0;
    $currentDate = Carbon\Carbon::now()->format("Y-m-d");
    $yearCurrent = Carbon\Carbon::now()->format("Y");
    $monthCurrent = Carbon\Carbon::now()->format("m");
    foreach ($payments as $payment) {
        $yearPayment = Carbon\Carbon::createFromFormat('Y-m-d', $payment->realdate)->format('Y');
        $monthPayment = Carbon\Carbon::createFromFormat('Y-m-d', $payment->realdate)->format('m');

        if ($payment->ispayment == 'N') {
            if ($yearPayment <= $yearCurrent && $monthPayment <= $monthCurrent) {
                if ($currentDate <= $payment->date1) {
                    $subtotal += $payment->value1;
                } elseif ($currentDate > $payment->date1 && $currentDate <= $payment->date2) {
                    $subtotal += $payment->value2;
                } else {
                    $subtotal += $payment->value3;
                }
            } else {
                $subtotal += $payment->value1;
            }
        }

    }
    return $subtotal;
}

/**
 * Get Real Value Paid
 * @param $payment
 * @return int
 */
function paymentRealValue($payment)
{
    $currentDate = Carbon\Carbon::now()->format("Y-m-d");
    $yearCurrent = Carbon\Carbon::now()->format("Y");
    $monthCurrent = Carbon\Carbon::now()->format("m");

    $yearPayment = Carbon\Carbon::createFromFormat('Y-m-d', $payment->realdate)->format('Y');
    $monthPayment = Carbon\Carbon::createFromFormat('Y-m-d', $payment->realdate)->format('m');

    if ($payment->ispayment == 'N') {
        if ($yearPayment <= $yearCurrent && $monthPayment <= $monthCurrent) {
            if ($currentDate <= $payment->date1) {
                $total = $payment->value1;
            } elseif ($currentDate > $payment->date1 && $currentDate <= $payment->date2) {
                $total = $payment->value2;
            } else {
                $total = $payment->value3;
            }
        } else {
            $total = $payment->value1;
        }
    } else {
        $total = $payment->realValue;
    }

    return $total;
}

/**
 * Get Discount
 * @param $details
 * @param $discount
 * @return int
 */
function discount($details, $discount)
{
    $total = 0;
    foreach ($details as $detail) {
        $total += $detail->total;
    }
    return $total * $discount;
}


function vat($details, $discount)
{
    $vat = 0;
    foreach ($details as $detail) {
        $vat += ($detail->total - ($detail->total * $discount)) * $detail->vat;
    }
    return $vat;
}

/**
 * Get Total
 * @param $details
 * @param $discount
 * @return int
 */
function total($details, $discount)
{
    return (subtotal($details) - discount($details, $discount)) + vat($details, $discount);
}

/**
 * Set Status Class
 * @param $status
 * @return string
 */
function status($status)
{
    switch ($status) {
        case 1:
            return "status-1";
        case 2:
            return "status-2";
        case 3:
            return "status-3";
        case 4:
            return "status-4";
        case 5:
            return "status-5";
        default:
            return "status-1";
    }
}

/**
 * Rating Scale
 * @param $rating
 * @param $group
 * @return string
 * @internal param $scale
 */
function scale($rating, $group)
{
    if ($group < 21) {
        switch ($rating) {
            case ($rating >= 4.31 && $rating <= 5.00):
                return "DS";
            case ($rating >= 3.71 && $rating < 4.31):
                return "DA";
            case ($rating >= 3.00 && $rating < 3.71):
                return "DB";
            case ($rating > 0.00 && $rating < 3.00):
                return "DP";
            default:
                return "DP";
        }
    } else {
        return $rating;
    }
}

/**
 * Set Status List Class
 * @param $status
 * @return string
 */
function statusList($status)
{
    switch ($status) {
        case 4:
            return "status-list-4";
            break;
        case 1:
        case 2:
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
            return "status-list-1";
            break;
    }
}

/**
 * Set Status Photo Class
 * @param $status
 * @return string
 */
function statusPhoto($status)
{
    switch ($status) {
        case 1:
            return "status-photo-1";
            break;
        case 4:
            return "status-photo-4";
            break;
        case 2:
        case 3:
        case 5:
        case 6:
            return "status-photo-6";
            break;
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
            return "status-photo-1";
            break;
    }
}

/**
 * Task Status
 * @param $status
 * @return string
 */
function taskStatus($status)
{
    $result = 'draft';
    if ($status == 1) {
        $result = 'approved';
    }
    return $result;
}

/**
 * Provider Status
 * @param $evaluation
 * @return string
 */
function providerStatus($evaluation)
{
    $result = 'bad';
    if ($evaluation < 0.75) {
        $result = 'bad';
    } elseif ($evaluation >= 0.75 && $evaluation < 0.85) {
        $result = 'regular';
    } elseif ($evaluation >= 0.85 && $evaluation < 0.95) {
        $result = 'good';
    } else {
        $result = 'excellent';
    }
    return $result;
}

/**
 * Get Evaluations
 * @param $evaluations
 * @return int
 */
function purchaseEvaluations($evaluations)
{
    $sum = 0;
    $count = 0;
    foreach ($evaluations as $evaluation) {
        $sum += ($evaluation->opportunity + $evaluation->quality + $evaluation->service) / 3;
        $count++;
    }
    if ($count > 0) {
        return (($sum / $count) / 5);
    } else {
        return 0;
    }

}

/**
 * @param $status
 * @return string
 */
function isPaymentClass($status)
{
    $result = 'not-payment';
    if ($status == 'Y') {
        $result = 'is-payment';
    }
    return $result;
}

/**
 * Is Payment
 * @param $status
 * @return string
 */
function isPayment($status)
{
    $result = false;
    if ($status == 'Y') {
        $result = true;
    }
    return $result;
}

/**
 * Get Plural Days
 * @param $days
 * @return string
 */
function days($days)
{
    $text = '1 ' . Lang::get('sige.Day');
    if ($days > 1) {
        $text = $days . ' ' . Lang::get('sige.Days');
    }
    return $text;
}

/**
 * Verified
 * @param $verified
 * @return string
 */
function verifiedClass($verified)
{
    $result = 'not-verified';
    if ($verified == 'Y') {
        $result = 'is-verified';
    }
    return $result;
}

/**
 * Verified Asset
 * @param $verified
 * @return string
 */
function verifiedAssetClass($inventory)
{
    $result = 'not-verified';
    if (count($inventory) > 0) {
        $result = 'is-verified';
    }
    return $result;
}

/**
 * Generate Transaction ID
 * @return string
 */
function generateTransactionID()
{
    $date = date("Y-m-d");
    return "TNS-" . str_replace("-", "", $date) . "-" . strtoupper(str_random(4));
}


/**
 * Promote Student
 * @param $group
 * @return int
 * @todo Create Correlation table
 */
function promoteStudent($group)
{
    switch ($group) {
        case 7:
            return 11;
            break;
        case 8:
            return 12;
            break;
        default:
            return $group + 2;
    }
}

/**
 * Get Month Name
 * @param $month
 * @return int
 */
function getMonthName($month)
{
    switch ($month) {
        case 1:
            return Lang::get('Qualitify.January');
            break;
        case 2:
            return Lang::get('Qualitify.February');
            break;
        case 3:
            return Lang::get('Qualitify.March');
            break;
        case 4:
            return Lang::get('Qualitify.April');
            break;
        case 5:
            return Lang::get('Qualitify.May');
            break;
        case 6:
            return Lang::get('Qualitify.June');
            break;
        case 7:
            return Lang::get('Qualitify.July');
            break;
        case 8:
            return Lang::get('Qualitify.August');
            break;
        case 9:
            return Lang::get('Qualitify.September');
            break;
        case 10:
            return Lang::get('Qualitify.October');
            break;
        case 11:
            return Lang::get('Qualitify.November');
            break;
        case 12:
            return Lang::get('Qualitify.December');
            break;

    }
}

/**
 * Generate Passcode
 * @param int $digits
 * @return string
 */
function generatePasscode($digits = 4)
{
    $i = 0;
    $pin = "";
    while ($i < $digits) {
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

/**
 * Completar Código de Pago
 * @param $limit
 * @param $number
 * @return string
 */
function setZero($limit/*limit*/, $number/*value*/)
{
    $zerosnumber = $limit - strlen($number);
    $stringinitial = '';
    for ($i = 1; $i <= $zerosnumber; $i++) {
        $stringinitial = $stringinitial . '0';
    }
    return $stringinitial . $number;
}


/**
 * Get Cost Total
 * @param $details
 * @param $type
 * @return float
 */
function costTotal($details, $type)
{
    $subtotal = 0;
    foreach ($details as $detail) {
        if ($type == $detail->calculated) {
            $subtotal += ($detail->percentage < 1) ? $detail->value * (1 - $detail->percentage) : $detail->value;
        }
    }
    return round($subtotal);

}