import Model from './Model';
import {HTTP} from '../resources/resources';

class Voucherconsecutive extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Payments Pending
     * @param path
     * @param params
     */
    static getConsecutiveByVoucher(params) {
        return HTTP.get('/api/v1/voucherconsecutives/getconsecutivebyvoucher/', params);
    }

}

export default Voucherconsecutive;