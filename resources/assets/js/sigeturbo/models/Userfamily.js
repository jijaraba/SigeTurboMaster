import Model from './Model';
import {HTTP} from '../resources/resources';

class Userfamilies extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getUsersByFamily(path, params) {
        return HTTP.get(path, {
            params: params
        });
    }

}

export default Userfamilies;