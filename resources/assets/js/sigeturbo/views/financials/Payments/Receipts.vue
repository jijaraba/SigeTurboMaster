<template>
    <section class="receipts-list">
        <ul id="receipts-list" class="display-horizontal col-100">
            <template v-for="receipt in receipts">
                <li class="col-100">
                    <ul class="display-horizontal col-100 receipt">
                        <li class="col-05 select">
                            <input type="checkbox"/>
                        </li>
                        <li class="col-10 photo">
                            <div>
                                <a href="">
                                    <img class="tooltip" :src=" assets + '/img/users/' + receipt.photo"
                                         :alt="receipt.fullname"
                                         :title="receipt.iduser + ' - ' + receipt.fullname"/>
                                </a>
                            </div>
                        </li>
                        <li class="col-15 vouchertype">
                            <div>{{ receipt.vouchertype }}</div>
                        </li>
                        <li class="col-15 document">
                            <div>{{ receipt.document }}</div>
                        </li>
                        <li class="payments col-25">
                            <div>
                                <section class="payment-calendar">
                                    <ul class="col-100">
                                        <li v-for="payment in receipt.receiptpayments">
                                            <sigeturbo-payments-payment :payment="payment" banks="banks"
                                                                        :server-date="serverDate"
                                                                        :banks="banks"></sigeturbo-payments-payment>
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </li>
                        <li class="col-20 pending">
                            <div>{{ receipt.receiptpayments | chargeTotalRealValue | currency }}</div>
                        </li>
                        <li class="col-05 receipt">
                            <div>
                                <i class="fas fa-receipt fa-2x"></i>
                            </div>
                        </li>
                        <li class="col-05 export">
                            <div>
                                <i class="fas fa-file-pdf fa-2x"></i>
                            </div>
                        </li>
                    </ul>
                </li>
            </template>
        </ul>
    </section>
</template>
<script>

    import capitalize from "../../../filters/string/capitalize";
    import currency from '../../../filters/other/currency';
    import uppercase from "../../../filters/string/uppercase";
    import titlecase from "../../../filters/string/titlecase";
    import {chargeSubtotal, chargeTotal, chargeTotalRealValue} from "../../../filters/payment/charge";
    import PaymentsPayment from '../../../views/financials/Payments/Payment/Payment';
    import assets from "../../../core/utils";
    import Bank from "../../../models/Bank";
    import Receipt from "../../../models/Receipt";

    export default {

        props: [
            'serverDate'
        ],
        filters: {
            capitalize: capitalize,
            uppercase: uppercase,
            titlecase: titlecase,
            currency: currency,
            chargeSubtotal: chargeSubtotal,
            chargeTotal: chargeTotal,
            chargeTotalRealValue: chargeTotalRealValue,
        },
        components: {
            'sigeturbo-payments-payment': PaymentsPayment,
        },
        data: function () {
            return {
                assets: assets(),
                receipts: [],
                vouchertype: 'all'
            }
        },
        methods: {
            loadReceipts() {
                Receipt.getReceiptsByVouchertype({
                    vouchertype: this.vouchertype
                }).then(({data}) => {
                    this.receipts = data;
                }).catch(error => console.log(error));
            }
        },
        watch: {},
        created() {
            //Get Banks
            Bank.query('/api/v1/banks/', {})
                .then(({data}) => {
                    this.banks = data;
                })
                .catch(error => console.log(error));

            //Load Receipts
            this.loadReceipts();
        },
        mounted() {
        },
    }

</script>