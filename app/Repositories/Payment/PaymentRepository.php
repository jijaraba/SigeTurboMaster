<?php

namespace SigeTurbo\Repositories\Payment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Payment;
use SigeTurbo\Repositories\Userfamily\UserfamilyRepository;
use SigeTurbo\Repositories\Year\YearRepository;
use SigeTurbo\Statusschooltype;
use SigeTurbo\Userfamily;
use SigeTurbo\Visitor;

class PaymentRepository implements PaymentRepositoryInterface
{

    /**
     * Return all values
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('payments', 1440, function () {
            return Payment::all();
        });
    }

    /**
     * Find in Databases
     * @param $payment
     * @return mixed
     */
    public function find($payment)
    {
        return Payment::find($payment);
    }

    /**
     * Get Payments
     * @param $user
     * @param bool $pending
     * @param null $sort
     * @param string $order
     * @param bool $excludeCurrentMonth
     * @return mixed
     */
    public function getPaymentsByUser($user, $pending = false, $sort = null, $order = 'ASC', $excludeCurrentMonth = false)
    {
        $payments = Payment::select('payments.*', 'users.photo', DB::raw('CONCAT_WS(CONVERT(" " USING latin1),users.lastname,users.firstname) AS fullname'), DB::raw('CURDATE() AS current'))
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'payments.iduser');
            })
            ->join('families', function ($join) {
                $join->on('families.idfamily', '=', 'payments.idfamily');
            })
            ->where('families.idfamily', '=', DB::raw("(SELECT idfamily FROM userfamilies WHERE userfamilies.iduser = $user LIMIT 1)"));


        //Exceptions: Families with multiple children
        switch ($user) {
            case 43754648:
                $payments->orWhereIn('payments.iduser', [2014067]);
                break;
            case 71798002:
                $payments->orWhereIn('payments.iduser', [2016116, 2016031, 2017008]);
                break;
            case 43906017:
                $payments->orWhereIn('payments.iduser', [2017003]);
                break;
        }

        //Payments Pending
        if ($pending) {
            $payments->where('payments.ispayment', '=', 'N');
        }

        //Exclude Current Mont
        if ($excludeCurrentMonth) {
            $payments
                ->where(DB::raw("CONVERT(CONCAT(YEAR(payments.realdate), MONTH(payments.realdate)),SIGNED INTEGER)"), "<", DB::raw("CONVERT(CONCAT(YEAR(CURDATE()), MONTH(CURDATE())),SIGNED INTEGER)"));
        }

        //Sort
        switch ($sort) {
            case 'realdate':
                $payments->orderBy('payments.realdate', $order);
                break;
            case 'ispayment':
                $payments->orderBy('payments.ispayment', $order);
                break;
            case 'created_at':
                $payments->orderBy('payments.created_at', $order);
                break;
            default:
                $payments->orderBy('payments.created_at', $order);
        }
        return $payments
            ->get();
    }

    /**
     * Get Payments With User Info
     * @param $payment
     * @return mixed
     */
    public function getPaymentByID($payment)
    {
        return Payment::select('payments.*', DB::raw('CURDATE() as currentDate'), DB::raw("CONCAT_WS(CONVERT(' ' USING latin1),users.lastname,users.firstname) AS student"), 'users.photo')
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'payments.iduser');
            })
            ->where('idpayment', '=', $payment)
            ->first();
    }

    /**
     * Set Payment Method
     * @param $data
     * @return mixed
     */
    public function setPaymentMethod($data)
    {
        //Find Payment
        $payment = Payment::find($data['payment']);
        $payment->fill(array(
            'method' => $data['method'],
            'hash' => $data['hash'],
            'transaccionTNS' => $data['transaccionTNS'],
            'approved' => $data['approved'],
            'realValue' => $data['realValue'],
        ));
        return $payment->save();
    }

    /**
     * Set Payment Agreement
     * @param $data
     * @return mixed
     */
    public function setPaymentAgreement($data)
    {
        //Find Payment
        $payment = Payment::find($data['payment']);
        $payment->fill(array(
            'value4' => $data['value'],
        ));
        return $payment->save();
    }

    /**
     * Set Payment Status
     * @param $payment
     * @param $data
     * @param $dataCPV
     * @return mixed
     */
    public function setPaymentStatus($payment, $data, $dataCPV)
    {

        //Find Payment
        $payment = Payment::find($payment);
        $payment->fill(array(
            'transaccionId' => $data['transaccionId'],
            'approved' => $dataCPV['aprobado'],
            'uuid' => $data['uuid'],
            'realValue' => $data['valor'],
            'ispayment' => $this->isPayment($payment, $data, $dataCPV),
            'payment_at' => Carbon::now(),
            'payment_by' => getUser()->iduser,
        ));
        return $payment->save();
    }

    /**
     * Set Payment Verify
     * @param $payment
     * @param $dataCPV
     * @return mixed
     */
    public function verifyPaymentPending($payment, $dataCPV)
    {

        //Find Payment
        $payment = Payment::find($payment);
        $payment->fill(array(
            'transaccionId' => $dataCPV['transaccionId'],
            'approved' => $dataCPV['aprobado'],
            'uuid' => $dataCPV['uuid'],
            'realValue' => $this->_setRealValueForPaymentPending($payment),
            'ispayment' => "Y",
            'payment_at' => Carbon::createFromTimestamp($dataCPV['fechaTransaccion'])->format("Y-m-d"),
            'verified_by' => getUser()->iduser,
        ));
        return $payment->save();
    }

    /**
     * Is Payment?
     * @param $payment
     * @param $data
     * @param $dataCPV
     * @return string
     */
    private function isPayment($payment, $data, $dataCPV)
    {

        $ispayment = 'N';

        switch ($payment->method) {
            case 'discount':
                if (((double)$payment->value1 == (double)$data['valor']) && $dataCPV["aprobado"] == 'A') {
                    $ispayment = 'Y';
                }
                break;
            case 'normal':
                if (((double)$payment->value2 == (double)$data['valor']) && $dataCPV["aprobado"] == 'A') {
                    $ispayment = 'Y';
                }
                break;
            case 'rate':
                if (((double)$payment->value3 == (double)$data['valor']) && $dataCPV["aprobado"] == 'A') {
                    $ispayment = 'Y';
                }
                break;
            case 'agreement':
                if (((double)$payment->value4 == (double)$data['valor']) && $dataCPV["aprobado"] == 'A') {
                    $ispayment = 'Y';
                }
                break;
            default:
                $ispayment = 'N';
        }
        return $ispayment;
    }

    /**
     * Get Payment By Transaction ID
     * @param $transactionID
     * @return mixed
     */
    public function getPaymentByTransactionID($transactionID)
    {
        return Payment::select('payments.*')
            ->where('transaccionTNS', '=', $transactionID)
            ->first();
    }

    /**
     * Save Payment Individual
     * @param $family
     * @param $data
     * @return static
     */
    public function setPaymentIndividual($family, $data)
    {
        $realdate = Carbon::create($data['year'], $data['month'], 1, 0, 0, 0);
        return Payment::create([
            'idpaymenttype' => $data['type'],
            'idbank' => 1,
            'idfamily' => $family,
            'iduser' => $data['student'],
            'concept1' => $this->setConcept(1, 1, $data),
            'value1' => $data['value1'],
            'date1' => $data['date1'],
            'observation1' => $this->setConcept(1, 2, $data),
            'concept2' => $this->setConcept(2, 1, $data),
            'value2' => $data['value2'],
            'date2' => $data['date2'],
            'observation2' => $this->setConcept(2, 2, $data),
            'concept3' => $this->setConcept(3, 1, $data),
            'value3' => $data['value3'],
            'date3' => $data['date3'],
            'observation3' => $this->setConcept(3, 2, $data),
            'concept4' => $this->setConcept(4, 1, $data),
            'value4' => $data['value4'],
            'date4' => $data['date4'],
            'observation4' => $this->setConcept(4, 2, $data),
            'created_by' => getUser()->iduser,
            'realdate' => $realdate->lastOfMonth(),
        ]);
    }

    /**
     * Update Payment
     * @param $idpayment
     * @param $data
     * @return mixed
     */
    public function update($idpayment, $data)
    {
        //Find Payment
        $payment = Payment::find($idpayment);
        $payment->fill(array(
            'method' => $data['method'],
            'idpaymenttype' => $data['type'],
            'idfamily' => $data['family'],
            'iduser' => $data['student'],
            'ispayment' => $data['ispayment'],
            'approved' => $data['approved'],
            'idbank' => $data['bank'],
            'voucher' => $data['voucher'],
            'concept1' => $data['concept1'],
            'date1' => $data['date1'],
            'value1' => $data['value1'],
            'observation1' => $data['observation1'],
            'concept2' => $data['concept2'],
            'date2' => $data['date2'],
            'value2' => $data['value2'],
            'observation2' => $data['observation2'],
            'concept3' => $data['concept3'],
            'date3' => $data['date3'],
            'value3' => $data['value3'],
            'observation3' => $data['observation3'],
            'concept4' => $data['concept4'],
            'date4' => $data['date4'],
            'value4' => $data['value4'],
            'observation4' => $data['observation4'],
            'observation' => $data['observation'],
            'realValue' => $data['value'],
            'updated_by' => getUser()->iduser,
        ));
        return $payment->save();
    }

    public function updatePaymentShort($data)
    {
        //Find Payment
        $payment = Payment::find($data['payment']);
        $payment->fill(array(
            'ispayment' => 'Y',
            'approved' => 'A',
            'idbank' => $data['bank'],
            'voucher' => $data['voucher'],
            'realValue' => $data['value'],
            'method' => $data['method'],
            'observation' => ($data['observation']) ? $data['observation'] : null,
            'updated_by' => getUser()->iduser,
            'payment_at' => ($data["date"]) ? $data["date"] : Carbon::now(),
        ));
        return $payment->save();
    }

    /**
     * Updated Payment Rejected
     * @param $data
     * @return mixed
     */
    public function updatePaymentRejected($data)
    {
        //Find Payment
        $payment = Payment::find($data['payment']);
        $payment->fill(array(
            'ispayment' => 'N',
            'approved' => 'N',
            'method' => 'normal',
            'transaccionTNS' => null,
            'hash' => null,
            'observation' => null,
            'updated_by' => getUser()->iduser,
            'updated_at' => Carbon::now(),
        ));
        return $payment->save();
    }

    /**
     * Get All Payments With Transactions
     * @param $user
     * @return mixed
     */
    public function getPaymentsByUserWithTransactions($user)
    {
        return Payment::select('payments.*')
            ->where('iduser', '=', $user)
            ->with('transactions')
            ->orderBy('payments.realdate', 'DESC')
            ->get();
    }

    /**
     * Get Payments Pendings
     * @return mixed
     */
    public function getPaymentsPendings()
    {
        return Payment::select('payments.*')
            ->whereApproved('P')
            ->get();
    }

    /**
     * Get Payments BY Year AND Month
     * @param $year
     * @param $month
     * @return mixed
     */
    public function getPaymentsByYearAndMonth($year, $month)
    {
        return Payment::select("payments.*")
            ->join('users', function ($join) {
                $join->on('users.iduser', '=', 'payments.iduser');
            })
            ->join('enrollments', function ($join) {
                $join->on('enrollments.iduser', '=', 'users.iduser');
            })
            ->join('groups', function ($join) {
                $join->on('groups.idgroup', '=', 'enrollments.idgroup');
            })
            ->whereRaw("YEAR(realdate) = $year AND MONTH(`realdate`) = $month")
            ->where("enrollments.idyear", '=', 2017)
            ->whereNotIn("enrollments.idstatusschooltype", Statusschooltype::STATUS_NOT_ACTIVE)
            ->whereNotIn("enrollments.idstatusschooltype", [13])
            ->orderBy('groups.order', 'ASC')
            ->orderBy('users.lastname', 'ASC')
            ->get();
    }

    /**
     * Get Payments Approved For Receipt
     * @param $year
     * @param $month
     * @return mixed
     */
    public function getPaymentsApprovedByYearAndMonth($year, $month)
    {
        return Payment::select("payments.*")
            ->whereRaw("YEAR(realdate) = $year AND MONTH(`realdate`) = $month")
            ->where('isPayment', '=', 'Y')
            ->whereApproved('A')
            ->where('idbank', '<>', 1)
            ->get();
    }


    /**
     * Get Payments Virtual Approved For Receipt
     * @param $year
     * @param $month
     * @return mixed
     */
    public function getPaymentsVirtualApprovedByYearAndMonth($year, $month)
    {
        return Payment::select("payments.*")
            ->whereRaw("YEAR(realdate) = $year AND MONTH(`realdate`) = $month")
            ->where('isPayment', '=', 'Y')
            ->whereApproved('A')
            ->where('idbank', '=', 1)
            ->get();
    }


    /**
     * Set RealValue for Pending Payment
     * @param $payment
     * @return mixed
     */
    private function _setRealValueForPaymentPending($payment)
    {
        switch ($payment->method) {
            case 'discount':
                return $payment->value1;
                break;
            case 'normal':
                return $payment->value2;
                break;
            case 'rate':
                return $payment->value3;
                break;
            case 'agreement':
                return $payment->value4;
                break;
        }
    }

    /**
     * @param $year
     * @param $group
     * @param $cost
     * @param $student
     * @param null $config
     * @return null
     */
    public function configDataPayment($year, $group, $cost, $student, $config = null)
    {
        //Put data
        if ($config !== null) {
            $data = $config;
        } else {
            $data["concept"] = "MATRÍCULA AÑO ACADÉMICO " . $year . "-" . ($year + 1);
            $data["date1"] = '2017-06-30';
            $data["date2"] = '2017-07-15';
            $data["date3"] = '2017-07-16';
            $data["date4"] = '2017-07-16';
            $data["academic"] = $year;
            $data["year"] = Carbon::now()->year;
            $data["month"] = Carbon::now()->month;
            $data["month_name"] = getMonthName(Carbon::now()->month);
            $data["type"] = 1;
            $data["exclude"] = 0;
        }

        $data["student"] = $student->iduser;
        $data["value1"] = $cost->enrollment;
        $data["value2"] = $cost->enrollment;
        $data["value3"] = $cost->enrollment_expired;
        $data["value4"] = $cost->enrollment;
        $data["firstname"] = $student->firstname;
        $data["lastname"] = $student->lastname;
        $data["gender"] = $student->gender;
        $data["scholarship"] = $student->scholarship;
        return $data;
    }


    /**
     * Specify Payment Criteria
     * @param $number
     * @param $option
     * @param $data
     * @return string
     */
    private function setConcept($number, $option, $data)
    {
        switch ($number) {
            case 1:
                switch ($data["type"]) {
                    case 2:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . (($data["scholarship"] > 0.00) ? " CON BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . (($data["scholarship"] > 0.00) ? " CON BECA DEL " . $data["scholarship"] * 100 . "% DE " : " DE ") . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                    case 1:
                        if ($option == 1) {
                            return $data['concept'] . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")";
                        }
                        break;
                    case 3:
                    case 4:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                }
                break;
            case 2:
                switch ($data["type"]) {
                    case 2:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . (($data["scholarship"] > 0.00) ? " CON BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . (($data["scholarship"] > 0.00) ? " CON BECA DEL " . $data["scholarship"] * 100 . "% DE " : " DE ") . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                    case 1:
                        if ($option == 1) {
                            return $data['concept'] . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")";
                        }
                        break;
                    case 3:
                    case 4:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                }
                break;
            case 3:
                switch ($data["type"]) {
                    case 2:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " CON INTERESES" . (($data["scholarship"] > 0.00) ? " Y BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON INTERESES" . (($data["scholarship"] > 0.00) ? " Y BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                    case 1:
                        if ($option == 1) {
                            return $data['concept'] . " CON RECARGO " . "(" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON RECARGO" . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")";
                        }
                        break;
                    case 3:
                    case 4:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " CON INTERESES" . "(" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON INTERESES" . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                }
                break;
            case 4:
                switch ($data["type"]) {
                    case 2:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " CON ACUERDO DE PAGO" . (($data["scholarship"] > 0.00) ? " Y BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " (" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON ACUERDO DE PAGO" . (($data["scholarship"] > 0.00) ? " Y BECA DEL " . $data["scholarship"] * 100 . "% " : "") . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                    case 1:
                        if ($option == 1) {
                            return $data['concept'] . " CON ACUERDO DE PAGO " . "(" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON ACUERDO DE PAGO" . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")";
                        }
                        break;
                    case 3:
                    case 4:
                        if ($option == 1) {
                            return $data['concept'] . " " . $data['month_name'] . " CON INTERESES" . "(" . $data['student'] . " - " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . ")";
                        } else {
                            return "PAGO " . $data['concept'] . " CON ACUERDO DE PAGO" . " DE " . (($data['gender'] == 1) ? "EL" : "LA") . " ESTUDIANTE " . mb_strtoupper($data['firstname']) . " " . mb_strtoupper($data['lastname']) . " (" . $data['student'] . ")" . " CORRESPONDIENTE AL MES DE " . $data['month_name'];
                        }
                        break;
                }
                break;
        }
    }

}
