<template>
    <ul class="display-horizontal col-100">
        <li class="col-05 check">
            <div>
                <input type="checkbox">
            </div>
        </li>
        <li class="col-05 icon">
            <template v-if="payment.ispayment == 'N'">
                <div>
                    <img :src="assets + '/img/modules/payment_notpayment.svg'"/>
                    <em :class="payment.method"></em>
                </div>
            </template>
            <template v-if="payment.ispayment == 'P'">
                <div>
                    <img :src="assets + '/img/modules/payment_partial.svg'"/>
                    <em :class="payment.method" :title="payment.method"></em>
                </div>
            </template>
            <template v-if="payment.ispayment == 'Y'">
                <div>
                    <img :src="assets + '/img/modules/payment_approved.svg'"/>
                    <em :class="payment.method" :title="payment.method"></em>
                </div>
            </template>
        </li>
        <li class="col-10 type">
            <div>
                {{ payment.idpaymenttype | paymentType }}
            </div>
        </li>

        <li class="col-35 concept">
            <div>
                {{ payment.concept1 }}
            </div>
        </li>
        <li class="col-15 value">
            <div>
                {{ payment | realValue(serverDate) | currency }}
            </div>
        </li>
        <li class="col-15 value">
            <div>
                <input type="text" v-model="payment.receipt_value">
            </div>
        </li>
        <li class="col-05 delete">
            <div @click="removePayment()">
                <i class="fas fa-minus-square fa-lg"></i>
            </div>
        </li>
    </ul>
</template>
<script>

    import moment from 'moment';
    import assets from "../../../../core/utils";
    import currency from "../../../../filters/other/currency";
    import paymentType from "../../../../filters/payment/paymentType";
    import {realValue} from "../../../../filters/payment/charge";

    export default {

        props: [
            'payment',
            'position',
        ],
        filters: {
            currency: currency,
            paymentType: paymentType,
            realValue: realValue,
        },
        components: {},
        data: function () {
            return {
                assets: assets(),
                serverDate: moment().format('YYYY-MM-DD')
            }
        },
        methods: {
            removePayment() {
                this.$emit('removePayment', this.payment)
            }
        },
        watch: {
            'payment.receipt_value': function (newReceiptValue) {
                this.$emit('calculateTotal');
            }
        },
        created() {
        },
        mounted() {
        },
    }

</script>