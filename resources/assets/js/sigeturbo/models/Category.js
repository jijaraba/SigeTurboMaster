import Model from './Model';
import {HTTP} from '../resources/resources';

class Category extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Costs By Concept
     * @param path
     * @param params
     */
    static getCategoryCodeByName(params) {
        return HTTP.get('/api/v1/categories/getcategorycodebyname', {
            params: params
        });
    }

}

export default Category;