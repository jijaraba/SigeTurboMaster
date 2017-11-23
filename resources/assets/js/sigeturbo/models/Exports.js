import Model from './Model';
import {HTTP} from '../resources/resources';

class Exports extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getPartialReport(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

}

export default Exports;