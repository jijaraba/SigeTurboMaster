<template>
    <section>
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
                        <em @click="showDetailChangeForm()"
                            :class="{ 'discount': payment.real_method == 'discount', 'normal': payment.real_method == 'normal','expired': payment.real_method == 'expired'}"></em>
                    </div>
                </template>
                <template v-if="payment.ispayment == 'P'">
                    <div>
                        <img :src="assets + '/img/modules/payment_partial.svg'"/>
                        <em @click="showDetailChangeForm()"
                            :class="{ 'discount': payment.real_method == 'discount', 'normal': payment.real_method == 'normal','expired': payment.real_method == 'expired'}"></em>
                    </div>
                </template>
                <template v-if="payment.ispayment == 'Y'">
                    <div>
                        <img :src="assets + '/img/modules/payment_approved.svg'"/>
                        <em @click="showDetailChangeForm()"
                            :class="{ 'discount': payment.real_method == 'discount', 'normal': payment.real_method == 'normal','expired': payment.real_method == 'expired'}"></em>
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
        <section class="detail-change-method padding-20" v-if="showDetailChange">
            <div class="close" @click="closeDetailChangeForm()">
                <i class="fas fa-times" aria-hidden="true"></i>
            </div>
            <ul class="display-horizontal detail-change">
                <li class="col-100">
                    <ul class="display-horizontal col-100">
                        <li class="col-10"><em class="discount"></em></li>
                        <li class="col-35">{{ $translate.text('sigeturbo.discount') | uppercase }}</li>
                        <li class="col-35 value">{{ payment.value1 | currency }}</li>
                        <li class="col-20"><a href="#" @click="changeValue($event,1)">{{
                            $translate.text('sigeturbo.change') | capitalize }}</a></li>
                    </ul>
                </li>
                <li class="col-100">
                    <ul class="display-horizontal col-100">
                        <li class="col-10"><em class="normal"></em></li>
                        <li class="col-35">{{ $translate.text('sigeturbo.normal') | uppercase }}</li>
                        <li class="col-35 value">{{ payment.value2 | currency }}</li>
                        <li class="col-20"><a href="#" @click="changeValue($event,2)">{{
                            $translate.text('sigeturbo.change') | capitalize }}</a></li>
                    </ul>
                </li>
                <li class="col-100">
                    <ul class="display-horizontal col-100">
                        <li class="col-10"><em class="expired"></em></li>
                        <li class="col-35">{{ $translate.text('sigeturbo.expired') | uppercase }}</li>
                        <li class="col-35 value">{{ payment.value3 | currency }}</li>
                        <li class="col-20"><a href="#" @click="changeValue($event,3)">{{
                            $translate.text('sigeturbo.change') | capitalize }}</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </section>
</template>
<script>

    import moment from 'moment';
    import assets from "../../../../core/utils";
    import currency from "../../../../filters/other/currency";
    import paymentType from "../../../../filters/payment/paymentType";
    import {realValue} from "../../../../filters/payment/charge";
    import uppercase from "../../../../filters/string/uppercase";
    import capitalize from "../../../../filters/string/capitalize";

    export default {

        props: [
            'payment',
            'position',
        ],
        filters: {
            currency: currency,
            uppercase: uppercase,
            capitalize: capitalize,
            paymentType: paymentType,
            realValue: realValue,
        },
        components: {},
        data: function () {
            return {
                showDetailChange: false,
                assets: assets(),
                serverDate: moment().format('YYYY-MM-DD')
            }
        },
        methods: {
            changeValue(event, option) {
                event.preventDefault();
                switch (option) {
                    case 1:
                        this.payment.method = 'discount';
                        this.payment.real_method = 'discount';
                        this.payment.receipt_value = this.payment.value1;
                        this.payment.realValue = this.payment.value1;
                        break;
                    case 2:
                        this.payment.method = 'normal';
                        this.payment.real_method = 'normal';
                        this.payment.receipt_value = this.payment.value2;
                        this.payment.realValue = this.payment.value1;
                        break;
                    case 3:
                        this.payment.method = 'expired';
                        this.payment.real_method = 'expired';
                        this.payment.receipt_value = this.payment.value3;
                        this.payment.realValue = this.payment.value1;
                        break;
                }

            },
            removePayment() {
                this.$emit('removePayment', this.payment)
            },
            showDetailChangeForm() {
                this.showDetailChange = true;
            },
            closeDetailChangeForm() {
                this.showDetailChange = false;
            },
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