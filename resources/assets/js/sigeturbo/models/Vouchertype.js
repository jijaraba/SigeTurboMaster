import Model from './Model';
import {HTTP} from '../resources/resources';

class Vouchertype extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get All Voucher Types
     * @param path
     * @param params
     */
    static getVouchertypes(params) {
        return HTTP.get('/api/v1/vouchertypes/getvouchertypes/', params);
    }
}

export default Vouchertype;