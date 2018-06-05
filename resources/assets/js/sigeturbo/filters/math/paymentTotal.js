/**
 *  paymentTotal
 * 'subtotals' => 'subtotal'
 */

function paymentTotal(details, type) {
    let subtotal = 0;
    details.forEach(function (detail) {
        if (type == detail.calculated) {
            subtotal += (detail.percentage < 1) ? detail.value * (1 - detail.percentage) : detail.value;
        }
    });
    return Math.round(subtotal);
}

export default paymentTotal;