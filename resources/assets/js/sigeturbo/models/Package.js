import Model from './Model';
import {HTTP} from '../resources/resources';

class Package extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Packages By Concept
     * @param path
     * @param params
     */
    static getPackagesByConcept(params) {
        return HTTP.get('/api/v1/packages/getpackagesbyconcept', {
            params: params
        });
    }

}

export default Package;