import Model from './Model';
import {HTTP} from '../resources/resources';

class Receipt extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Update Profile General
     * @param path
     * @param params
     */
    static getReceiptsByVouchertype(params) {
        return HTTP.get('/api/v1/receipts/getreceiptsbyvouchertype/', {params});
    }

}

export default Receipt;