import Model from './Model';
import {HTTP} from '../resources/resources';

class Cost extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Costs By Concept
     * @param path
     * @param params
     */
    static getCostsByPackage(params) {
        return HTTP.get('/api/v1/costs/getcostsbypackage', {
            params: params
        });
    }

}

export default Cost;