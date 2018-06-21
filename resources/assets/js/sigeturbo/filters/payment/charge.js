/**
 *  Charge Total
 * 'charges' => 'total'
 */

import moment from "moment";

export function chargeSubtotal(charges, serverDate) {

    let total = 0;
    let dateCurrent = moment(serverDate, 'YYYY-MM-DD');

    charges.forEach(function (charge) {
        let dateCharge = moment(charge.realdate, 'YYYY-MM-DD');
        if (charge.ispayment === 'N') {
            if (dateCharge.isSameOrBefore(dateCurrent, 'year') && dateCharge.isSameOrBefore(dateCurrent, 'month')) {
                if (dateCurrent.isSameOrBefore(charge.date1)) {
                    total += charge.value1;
                    charge.realValue = charge.value1;
                    charge.receipt_value = charge.value1;
                    //charge.method = 'discount';
                } else if (dateCurrent.isAfter(charge.date1) && dateCurrent.isSameOrBefore(charge.date2)) {
                    total += charge.value2;
                    charge.realValue = charge.value2;
                    charge.receipt_value = charge.value2;
                    //charge.method = 'normal';
                } else {
                    total += charge.value3;
                    charge.realValue = charge.value3;
                    charge.receipt_value = charge.value3;
                    //charge.method = 'expired';
                }
            } else {
                total += charge.value1;
                charge.realValue = charge.value1;
                charge.receipt_value = charge.value1;
                //charge.method = 'discount';
            }
        } else if (charge.ispayment === 'P') {
            total += (charge.realValue - charge.receipt_realvalue);
            charge.receipt_value = (charge.realValue - charge.receipt_realvalue);
        }
    });

    return total;
}

export function chargeTotal(users, serverDate) {

    let total = 0;
    let dateCurrent = moment(serverDate, 'YYYY-MM-DD');

    users.forEach(function (user) {
        user.payments.forEach(function (charge) {
            let dateCharge = moment(charge.realdate, 'YYYY-MM-DD');
            if (charge.ispayment === 'N') {
                if (dateCharge.isSameOrBefore(dateCurrent, 'year') && dateCharge.isSameOrBefore(dateCurrent, 'month')) {
                    if (dateCurrent.isSameOrBefore(charge.date1)) {
                        total += charge.value1;
                        charge.realValue = charge.value1;
                        charge.receipt_value = charge.value1;
                        //charge.method = 'discount';
                    } else if (dateCurrent.isAfter(charge.date1) && dateCurrent.isSameOrBefore(charge.date2)) {
                        total += charge.value2;
                        charge.realValue = charge.value2;
                        charge.receipt_value = charge.value2;
                        //charge.method = 'normal';
                    } else {
                        total += charge.value3;
                        charge.realValue = charge.value3;
                        charge.receipt_value = charge.value3;
                        //charge.method = 'expired';
                    }
                } else {
                    total += charge.value1;
                    charge.realValue = charge.value1;
                    charge.receipt_value = charge.value1;
                    //charge.method = 'discount';
                }
            } else if (charge.ispayment === 'P') {
                total += (charge.realValue - charge.receipt_realvalue);
                charge.receipt_value = (charge.realValue - charge.receipt_realvalue);
            }
        });
    })
    return total;
}

export function realValue(charge, serverDate) {

    let value = 0;
    let dateCurrent = moment(serverDate, 'YYYY-MM-DD');
    let dateCharge = moment(charge.realdate, 'YYYY-MM-DD');
    if (charge.ispayment === 'N') {
        if (dateCharge.isSameOrBefore(dateCurrent, 'year') && dateCharge.isSameOrBefore(dateCurrent, 'month')) {
            if (dateCurrent.isSameOrBefore(charge.date1)) {
                value = charge.value1;
                //charge.method = 'discount';
            } else if (dateCurrent.isAfter(charge.date1) && dateCurrent.isSameOrBefore(charge.date2)) {
                value = charge.value2;
                //charge.method = 'normal';
            } else {
                value = charge.value3;
                //charge.method = 'expired';
            }
        } else {
            value = charge.value1;
            //charge.method = 'discount';
        }
    } else if (charge.ispayment === 'P') {
        value = charge.realValue;
    }
    return value;
}

export function chargeTotalRealValue(payments) {
    let total = 0;
    payments.forEach(function (charge) {
        total += parseFloat(charge.receipt_realvalue);
    });
    return total;
}

