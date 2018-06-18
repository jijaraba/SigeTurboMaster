<template>
    <section>
        <sigeturbo-search-list @result="result"></sigeturbo-search-list>
        <div class="clearfix"></div>
        <template v-if="users.length > 0">
            <section>
                <section class="payment-list">
                    <ul id="payment-list" class="display-horizontal col-100">
                        <template v-for="user in users">
                            <li class="col-100">
                                <ul class="display-horizontal col-100 payment">
                                    <li class="col-05 select">
                                        <input type="checkbox"/>
                                    </li>
                                    <li class="col-10 photo">
                                        <div>
                                            <a href="">
                                                <img class="tooltip" :src=" assets + '/img/users/' + user.photo"
                                                     :alt="user.fullname"
                                                     :title="user.iduser + ' - ' + user.fullname"/>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="col-15 family">
                                        <div>{{ user.family }}</div>
                                    </li>
                                    <li class="payments col-50">
                                        <div>
                                            <section class="payment-calendar">
                                                <ul class="col-100">
                                                    <li v-for="payment in user.payments">
                                                        <sigeturbo-payments-payment :payment="payment" banks="banks"
                                                                                    :server-date="serverDate"
                                                                                    :banks="banks"></sigeturbo-payments-payment>
                                                    </li>
                                                </ul>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="col-20 pending">
                                        <div>{{ user.payments | chargeSubtotal(serverDate) | currency }}</div>
                                    </li>
                                </ul>
                            </li>
                        </template>
                    </ul>
                </section>
                <section class="sige-payments-receipt">
                    <ul class="display-horizontal col-100 receipt">
                        <li class="col-60"></li>
                        <li class="col-05 receipt">
                            <a class="btn btn-purple" href="" :id="'receipt_'+user.iduser">
                                <i class="fas fa-envelope fa-lg"></i>
                            </a>
                        </li>
                        <li class="col-05 receipt">
                            <a class="btn btn-blue" href="" :id="'receipt_'+user.iduser">
                                <i class="fas fa-comment-alt fa-lg"></i>
                            </a>
                        </li>
                        <li class="col-05 receipt">
                            <a @click="showReceipt($event)" class="btn btn-green tooltip" title="Recibo" href="#"
                               :id="'receipt_'+user.iduser">
                                <i class="fas fa-receipt fa-lg"></i>
                            </a>
                        </li>
                        <li class="col-20 pending">
                            <div>
                                {{ users | chargeTotal(serverDate) | currency }}
                            </div>
                        </li>
                    </ul>
                </section>
                <sigeturbo-payments-receipt @close="closeReceipt" v-if="receipt" :payments="payments"
                                            show-receipt="receipt" :banks="banks"
                                            @reload="getPaymentsByFamily"></sigeturbo-payments-receipt>
            </section>
        </template>
    </section>
</template>
<script>

    import swal from 'sweetalert2';
    import currency from '../../../filters/other/currency';
    import Bank from '../../../models/Bank';
    import PaymentsPayment from '../../../views/financials/Payments/Payment/Payment';
    import assets from "../../../core/utils";
    import Payment from "../../../models/Payment";
    import {chargeTotal, chargeSubtotal} from "../../../filters/payment/charge";
    import capitalize from "../../../filters/string/capitalize";
    import PaymentReceipt from '../../../views/financials/Payments/Payment/Receipt';
    import uppercase from "../../../filters/string/uppercase";
    import SearchCodeGlobal from '../../../views/global/Search/Code/Global';

    export default {

        props: [
            'serverDate'
        ],
        filters: {
            capitalize: capitalize,
            uppercase: uppercase,
            currency: currency,
            chargeSubtotal: chargeSubtotal,
            chargeTotal: chargeTotal,
        },
        components: {
            'sigeturbo-payments-payment': PaymentsPayment,
            'sigeturbo-payments-receipt': PaymentReceipt,
            'sigeturbo-search-list': SearchCodeGlobal,
        },
        data: function () {
            return {
                assets: assets(),
                banks: [],
                users: [],
                user: [],
                category: 1, //Family,
                family: 0,
                search: 0,
                receipt: false,
                payments: [],
            }
        },
        methods: {
            //Get Payments By Student
            getPaymentsByStudent() {
                //Get Payment By Family
                Payment.getPaymentsByUser({
                    user: this.user
                }).then(({data}) => {
                    this.users = data;
                })
                    .catch(error => console.log(error));
            },
            //Get Payments By Family
            getPaymentsByFamily() {
                //Get Payment By Family
                this.payments = [];
                this.users = [];
                Payment.getPaymentsByFamily({
                    family: this.family
                }).then(({data}) => {
                    if (data.length > 0) {
                        this.users = data;
                        //Get Payments Pending
                        for (let i = 0; i < this.users.length; i++) {
                            for (let j = 0; j < this.users[i].payments.length; j++) {
                                if ((this.users[i].payments[j].ispayment === 'N') || (this.users[i].payments[j].ispayment === 'P')) {
                                    this.payments.push(this.users[i].payments[j]);
                                }
                            }
                        }
                    }
                }).catch(error => console.log(error));
            },
            showReceipt(event) {
                event.preventDefault();
                if (this.payments.length > 0) {
                    this.receipt = true;
                } else {
                    swal({
                        title: uppercase(this.$translate.text('sigeturbo.attention')),
                        text: capitalize(this.$translate.text('sigeturbo.payments_attention')),
                        type: 'info',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        if (result) {
                        }
                    });
                }
            },
            closeReceipt(receipt) {
                this.receipt = receipt;
            },
            result(data) {
                //Get Payments By Family
                if (data.successful) {
                    if (data.category == 1) {
                        this.family = data.search;
                        this.getPaymentsByFamily();
                    }
                } else {
                    this.users = [];
                }
            }
        },
        watch: {},
        created: function () {
            //Get Banks
            Bank.query('/api/v1/banks/', {})
                .then(({data}) => {
                    this.banks = data;
                })
                .catch(error => console.log(error));
        },
        mounted() {
        },
    }

</script>