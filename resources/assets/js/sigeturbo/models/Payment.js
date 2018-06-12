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
     * Get Payments Pending By User
     * @param path
     * @param params
     */
    static getPaymentsPendingByUser(params) {
        return HTTP.get('/api/v1/payments/getpaymentspendingbyuser', {
            params: params
        });
    }

    /**
     * Get Payments By User
     * @param path
     * @param params
     */
    static getPaymentsByUser(params) {
        return HTTP.get('/api/v1/users/getpaymentsbyuser', {
            params: params
        });
    }

    /**
     * Get Payments By Family
     * @param path
     * @param params
     */
    static getPaymentsByFamily(params) {
        return HTTP.get('/api/v1/families/getpaymentsbyfamily', {
            params: params
        });
    }

    /**
     * Generate Payment By User
     * @param path
     * @param params
     */
    static generatePaymentByUser(params) {
        return HTTP.post('/api/v1/payments/setpaymentindividualbyuser', params);
    }

}

export default Payment;