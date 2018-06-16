import Model from './Model';
import {HTTP} from '../resources/resources';

class Accountingentry extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Payments Pending
     * @param path
     * @param params
     */
    static getAccountingentriesByReceipt(params) {
        return HTTP.get('/api/v1/accountingentries/getaccountingentriesbyreceipt',  {params});
    }

}

export default Accountingentry;