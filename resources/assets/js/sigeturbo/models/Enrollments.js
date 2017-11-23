import Model from './Model';
import {HTTP} from '../resources/resources';

class Enrollments extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getEnrollments(path, params) {
        return HTTP.get(path + '/year/' + params.year + '/group/' + params.group);
    }

}

export default Enrollments;