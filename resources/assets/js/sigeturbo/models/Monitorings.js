import Model from './Model';
import {HTTP} from '../resources/resources';

class Monitorings extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getmMonitoringsPerformanceByStudent(params) {
        return HTTP.get('/api/v1/monitorings/getmonitoringsperformancebystudent', {
            params: params
        });
    }

}

export default Monitorings;