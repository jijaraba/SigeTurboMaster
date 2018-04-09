import Model from './Model';
import {HTTP} from '../resources/resources';

class Payments extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getPaymentsPendingByUser(params) {
        return HTTP.get('/api/v1/payments/getpaymentspendingsbyuser', {
            params: params
        });
    }

}

export default Payments;