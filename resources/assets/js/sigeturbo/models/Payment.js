import Model from './Model';
import {HTTP} from '../resources/resources';

class Payment extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Payments Pending
     * @param path
     * @param params
     */
    static getPaymentsPending(path, params) {
        return HTTP.get(path, params);
    }

    /**
     * Verify Payment Pending
     * @param path
     * @param params
     */
    static verifyPaymentPending(path, params) {
        return HTTP.post(path, params);
    }

    /**
     * Verify Payment Pending
     * @param path
     * @param params
     */
    static savePaymentIndividual(params) {
        return HTTP.post('/api/v1/payments/setpaymentindividualnew', params);
    }

    /**
     * Get Enrollments By Year and Group
     * @param path
     * @param params
     */
    static getPaymentsPendingByUser(params) {
        return HTTP.get('/api/v1/payments/getpaymentspendingbyuser', {
            params: params
        });
    }

}

export default Payment;