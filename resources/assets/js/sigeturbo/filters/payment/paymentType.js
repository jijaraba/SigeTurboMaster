/**
 *  Convert the given value to percent
 * 'value' => 'Abc'
 */

function paymentType(type) {
    if (type === 1) {
        return 'INDEFINIDO';
    } else if (type === 2) {
        return 'MATRÍCULA';
    } else if (type === 3) {
        return 'PENSIÓN';
    } else if (type === 4) {
        return 'EXTRACURRICULAR';
    } else if (type === 5) {
        return 'NIVELACIÓN';
    } else if (type === 6) {
        return 'VALIDACIÓN';
    } else {
        return 'OTROS';
    }
}

export default paymentType;

