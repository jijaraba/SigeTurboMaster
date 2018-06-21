import Model from './Model';
import {HTTP} from '../resources/resources';

class Exports extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Report
     * @param path
     * @param params
     */
    static getReport(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

    /**
     * Get
     * @param path
     * @param params
     */
    static getReceiptReport(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

}

export default Exports;