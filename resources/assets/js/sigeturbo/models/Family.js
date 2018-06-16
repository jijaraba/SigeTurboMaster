import Model from './Model';
import {HTTP} from '../resources/resources';

class Family extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Family By Name
     * @param path
     * @param params
     */
    static searchFamilyByName(params) {
        return HTTP.get('/api/v1/families/searchfamilybyname', {params});
    }

}

export default Family;