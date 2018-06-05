import Model from './Model';
import {HTTP} from '../resources/resources';

class Year extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    static getCurrentYear(params) {
        return HTTP.get('/api/v1/years/getcurrentyear', {
            params: params
        });
    }

}

export default Year;