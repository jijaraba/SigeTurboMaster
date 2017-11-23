import Model from './Model';
import {HTTP} from '../resources/resources';

class Reports extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getReportByStudent(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

}

export default Reports;