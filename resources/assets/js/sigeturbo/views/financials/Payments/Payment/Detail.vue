<template>
    <ul class="display-horizontal col-100">
        <li class="col-05 check">
            <div>
                <input type="checkbox">
            </div>
        </li>
        <li class="col-05 icon">
            <template v-if="payment.approved == 'N'">
                <div>
                    <img :src="assets + '/img/modules/payment_notpayment.svg'"/>
                    <em :class="payment.method">1</em>
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
                {{ payment | realValue | currency }}
            </div>
        </li>
        <li class="col-15 value">
            <div>
                <input type="text" v-model="payment.realValue">
            </div>
        </li>
        <li class="col-05 delete">
            <div @click="removePayment(index)">
                <i class="fas fa-minus-square fa-lg"></i>
            </div>
        </li>
    </ul>
</template>
<script>

    import assets from "../../../../core/utils";
    import currency from "../../../../filters/other/currency";
    import paymentType from "../../../../filters/payment/paymentType";
    import {realValue} from "../../../../filters/payment/charge";

    export default {

        props: [
            'payment',
            'detail',
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
            }
        },
        methods: {
            removePayment(index) {
                this.$emit('removePayment', index)
            }
        },
        watch: {
            'payment.realValue': function (newRealValue) {
                this.$emit('calculateTotal');
            }
        },
        created() {
        },
        mounted() {
        },
    }

</script>