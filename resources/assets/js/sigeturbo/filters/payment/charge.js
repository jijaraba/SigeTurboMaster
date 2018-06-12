/**
 *  Charge Total
 * 'charges' => 'total'
 */

import moment from "moment";

export function chargeSubtotal(charges) {

    let total = 0;
    let dateCurrent = moment().format('YYYY-MM-DD');
    let yearCurrent = moment().format('YYYY');
    let monthCurrent = moment().format('MM');

    charges.forEach(function (charge) {
        let yearCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
        let monthCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
        if (charge.ispayment === 'N') {
            if (yearCharge <= yearCurrent && monthCharge <= monthCurrent) {
                if (dateCurrent <= charge.date1) {
                    total += charge.value1;
                    charge.realValue = charge.value1;
                } else if (dateCurrent > charge.date1 && dateCurrent <= charge.date2) {
                    total += charge.value2;
                    charge.realValue = charge.value2;
                } else {
                    total += charge.value3;
                    charge.realValue = charge.value3;
                }
            } else {
                total += charge.value1;
                charge.realValue = charge.value1;
            }
        }
    });

    return total;
}

export function chargeTotal(users) {

    let total = 0;
    let dateCurrent = moment().format('YYYY-MM-DD');
    let yearCurrent = moment().format('YYYY');
    let monthCurrent = moment().format('MM');

    users.forEach(function (user) {
        user.payments.forEach(function (charge) {
            let yearCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
            let monthCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
            if (charge.ispayment === 'N') {
                if (yearCharge <= yearCurrent && monthCharge <= monthCurrent) {
                    if (dateCurrent <= charge.date1) {
                        total += charge.value1;
                        charge.realValue = charge.value1;
                    } else if (dateCurrent > charge.date1 && dateCurrent <= charge.date2) {
                        total += charge.value2;
                        charge.realValue = charge.value2;
                    } else {
                        total += charge.value3;
                        charge.realValue = charge.value3;
                    }
                } else {
                    total += charge.value1;
                    charge.realValue = charge.value1;
                }
            }
        });
    })
    return total;
}

export function realValue(charge) {

    let value = 0;
    let dateCurrent = moment().format('YYYY-MM-DD');
    let yearCurrent = moment().format('YYYY');
    let monthCurrent = moment().format('MM');

    let yearCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
    let monthCharge = moment(charge.realdate, 'YYYY-MM-DD').format("YYYY");
    if (charge.ispayment === 'N') {
        if (yearCharge <= yearCurrent && monthCharge <= monthCurrent) {
            if (dateCurrent <= charge.date1) {
                value = charge.value1;
                charge.method = 'discount';
            } else if (dateCurrent > charge.date1 && dateCurrent <= charge.date2) {
                value = charge.value2;
                charge.method = 'normal';
            } else {
                value = charge.value3;
                charge.method = 'expired';
            }
        } else {
            value = charge.value1;
            charge.method = 'discount';
        }
    }
    return value;
}

export function chargeTotalRealValue(payments) {
    let total = 0;
    payments.forEach(function (charge) {
        total += parseFloat(charge.realValue);
    });
    return total;
}

