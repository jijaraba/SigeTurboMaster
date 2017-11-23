/**
 *  Convert the given value to percent
 * 'abc' => 'Abc'
 */

function percentage(value, decimals) {
    if (!value) {
        value = 0;
    }

    if (!decimals) {
        decimals = 0;
    }
    value = value * 100;
    value = Math.round(value * Math.pow(10, decimals)) / Math.pow(10, decimals);
    value = value + '%';
    return value;
}

export default percentage;