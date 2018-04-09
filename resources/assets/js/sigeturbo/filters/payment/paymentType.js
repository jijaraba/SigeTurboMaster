/**
 *  Convert the given value to percent
 * 'value' => 'Abc'
 */

function paymentType(type) {
    if (type === 1) {
        return 'MATRÍCULA';
    } else if (type === 2) {
        return 'PENSIÓN';
    } else if (type === 3) {
        return 'EXTRACURRICULAR';
    } else if (type === 4) {
        return 'NIVELACIÓN';
    } else {
        return 'PENSIÓN';
    }
}

export default paymentType;

