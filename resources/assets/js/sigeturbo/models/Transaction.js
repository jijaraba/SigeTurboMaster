import Model from './Model';
import {HTTP} from '../resources/resources';

class Transaction extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Payments Pending
     * @param path
     * @param params
     */
    static getTransactionByPayment(params) {
        return HTTP.get('/api/v1/transactions/gettransactionsbypayment/', params);
    }

}

export default Transaction;