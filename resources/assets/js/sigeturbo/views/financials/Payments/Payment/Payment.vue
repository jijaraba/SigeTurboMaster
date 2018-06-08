<template>
    <section v-bind:class="payment.ispayment" class="is-payment" :title="payment.concept2">
        <img v-bind:class="(payment.idbank == 1)?'virtual':'normal'" v-if="payment.approved == 'A'"
             @click="verifyPaymentPending(payment)"
             :src='assets + "/img/modules/payment_approved.svg"'/>
        <img v-if="payment.approved == 'R'" :src='assets + "/img/modules/payment_rejected_real.svg"'/>
        <img class="animate-scale" @click="verifyPaymentPending(payment)" v-if="payment.approved == 'P'"
             :src='assets + "/img/modules/payment_pending.svg"'/>
        <template v-if="payment.approved == 'N'">
            <img  :src="assets + '/img/modules/payment_notpayment.svg'"/>
        </template>
        <em v-bind:class="(payment.idbank ==1 && payment.approved == 'A')?'virtual':'normal'">
            <i class="fa fa-link" aria-hidden="true"></i>
        </em>
        <span class="month" @click="showReceipt(payment.idpayment)"
              style="cursor: pointer">{{ payment.month_name }}</span>
        <span class="type">{{ payment.idpaymenttype | paymentType }}</span>
        <sigeturbo-payments-receipt @close="closeReceipt" v-if="receipt" :payment="payment"
                                    show-receipt="receipt"></sigeturbo-payments-receipt>
    </section>
</template>
<script>

    import moment from 'moment';
    import swal from 'sweetalert';
    import paymentType from '../../../../filters/payment/paymentType';
    import Payment from '../../../../models/Payment';
    import PaymentReceipt from '../../../../views/financials/Payments/Payment/Receipt';
    import assets from "../../../../core/utils";


    export default {

        props: [
            'serverDate',
            'payment',
            'banks'
        ],
        filters: {
            paymentType: paymentType
        },
        components: {
            'sigeturbo-payments-receipt': PaymentReceipt
        },
        data: function () {
            return {
                assets: assets(),
                load: 'no',
                dateCurrent: moment(this.serverDate).format('YYYY-MM-DD'),
                data: {
                    voucher: this.payment.voucher,
                    observation: this.payment.observation,
                    date: (this.payment.payment_at == null || this.payment.payment_at == '') ? this.dateCurrent :
                        moment(this.payment.payment_at, 'YYYY-MM-DD').format('YYYY-MM-DD')
                },
                receipt: false,
            }
        },
        methods: {

            //Verify Payment Pending
            verifyPaymentPending(payment) {

                Payment.verifyPaymentPending('/api/v1/payments/verifypaymentpending', {
                    payment: payment.idpayment
                })
                    .then(({data}) => {
                        if (data.payment.aprobado === 'A') {
                            this.payment.approved = 'A';
                            swal('Excelente', data.message, 'success');
                        } else if (data.payment.aprobado === 'P') {
                            this.payment.approved = 'P';
                            swal('Error', data.message, 'error');
                        } else if (data.payment.aprobado === 'R' || data.payment.aprobado === null) {
                            this.payment.approved = 'R';
                            swal('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        swal('Error', 'No se pudo verificar el pago', 'error');
                        console.log(error)
                    });
            },
            showReceipt() {
                this.receipt = true;
            },
            closeReceipt(receipt) {
                this.receipt = receipt;
            },

        },
        watch: {},
        created() {

            //Config Value By Default
            let dateDiscountPayment = moment(this.payment.date1, 'YYYY-MM-DD').format('YYYY-MM-DD');
            let dateNormalPayment = moment(this.payment.date2, 'YYYY-MM-DD').format('YYYY-MM-DD');
            let dateshortPayment = moment(this.payment.date1, 'YYYY-MM-DD').format('YYYY-MM');
            let dateshortCurrent = moment(this.serverDate, 'YYYY-MM-DD').format('YYYY-MM');


            if (this.payment.realValue == null) {
                if (dateshortPayment <= dateshortCurrent) {
                    if (dateDiscountPayment >= this.dateCurrent) {
                        //Payment With Discount
                        this.data.method = 'discount';
                        this.data.value = this.payment.value1;
                    } else if (dateNormalPayment >= this.dateCurrent) {
                        //Payment Normal
                        this.data.method = 'normal';
                        this.data.value = this.payment.value2;
                    } else {
                        //Payment With Rate
                        this.data.method = 'rate';
                        this.data.value = this.payment.value3;
                    }
                } else {
                    //Payment With Discount
                    this.data.method = 'discount';
                    this.data.value = this.payment.value1;
                }
            } else {
                //Payment With Discount
                this.data.method = this.payment.method;
                this.data.value = this.payment.realValue;
            }

        },
        mounted() {
        },
    }

</script>