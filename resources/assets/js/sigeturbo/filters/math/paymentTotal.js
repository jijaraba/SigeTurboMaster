/**
 *  paymentTotal
 * 'subtotals' => 'subtotal'
 */

function paymentTotal(details, method, type) {
    let subtotal = 0;
    details.forEach(function (detail) {
        if (method == detail.calculated && detail.transactiontype == type) {
            subtotal += (detail.percentage < 1) ? detail.value * (1 - detail.percentage) : detail.value;
        }
    });
    return Math.round(subtotal);
}

export default paymentTotal;