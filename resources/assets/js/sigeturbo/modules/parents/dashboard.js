/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../../bootstrap');

import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Translate from '../../plugins/Translate';
import Lang from '../../core/lang';
import PaymentPendingFamily from '../../views/financials/Payments/Pending/Family';

Vue.use(Translate, {
    locale: document.getElementsByTagName('html')[0].getAttribute('lang'),
    translates: Lang
});

new Vue({
    el: '#parents-dashboard',
    data: {},
    components: {
        'sigeturbo-payment-pending-family': PaymentPendingFamily
    }
});