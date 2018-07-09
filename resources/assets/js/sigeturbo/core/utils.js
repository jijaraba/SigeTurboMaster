/**
 * Assets
 * @returns {string}
 */
export function assets() {
    return 'https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com';
}

/**
 * Each
 * @param arr
 * @param callback
 * @returns {*}
 */
export function each(arr, callback) {
    let length = arr.length;
    let i;
    for (i = 0; i < length; i++) {
        callback.call(arr, arr[i], i, arr);
    }
    return arr;
}

