/**
 * Converts a string to titlecase
 * 'abc abc' => 'Abc Abc'
 */

function titlecase(value) {
    return value.replace(/\w\S*/g, function (value) {
        return value.charAt(0).toUpperCase() + value.substr(1).toLowerCase();
    });
}

export default titlecase;