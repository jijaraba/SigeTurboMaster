'use strict';

import {HTTP} from '../resources/resources';

const MyModel = class Model {

    constructor() {
        this.data = [];
    }

    /**
     * Get All Data
     * @param path
     */
    static all(path) {
        return HTTP.get(path);
    }

    /**
     * Get All Data With Params
     * @param path
     * @param params
     */
    static query(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

    /**
     * Find Data
     * @param path
     * @param id
     */
    static find(path, id) {
        return HTTP.get(path + '/' + id);
    }

    /**
     * Save Data
     * @param path
     * @param params
     * @returns {*|AxiosPromise}
     */
    static save(path, params) {
        return HTTP.post(path, params);
    }

    /**
     * Update Data
     * @param path
     * @param params
     * @returns {AxiosPromise}
     */
    static update(path, id, params) {
        return HTTP.put(path + id, params);
    }

    /**
     * Destroy Data
     * @param path
     * @param id
     */
    static remove(path, id) {
        return HTTP.delete(path + id);
    }
};

export default MyModel;