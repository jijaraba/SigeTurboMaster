<template>
    <section>
        <sigeturbo-search-list @result="result"></sigeturbo-search-list>
        <div class="clearfix"></div>
        <section>
            <template v-if="receipts.length > 0">
                <section class="receipts-list">
                    <template v-for="receipt in receipts">
                        <sigeturbo-receipt-show :server-date="serverDate" :banks="banks"
                                                :receipt="receipt"></sigeturbo-receipt-show>
                    </template>
                </section>
                <section></section>
            </template>
        </section>
    </section>
</template>
<script>

    import capitalize from "../../../filters/string/capitalize";
    import currency from '../../../filters/other/currency';
    import uppercase from "../../../filters/string/uppercase";
    import titlecase from "../../../filters/string/titlecase";
    import {chargeSubtotal, chargeTotal, chargeTotalRealValue} from "../../../filters/payment/charge";
    import {assets} from "../../../core/utils";
    import Bank from "../../../models/Bank";
    import Receipt from "../../../models/Receipt";
    import ReceiptShow from "../../../views/financials/Payments/Receipt/Show";
    import SearchReceiptGlobal from '../../../views/global/Search/Receipt/Global';

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
            'sigeturbo-receipt-show': ReceiptShow,
            'sigeturbo-search-list': SearchReceiptGlobal,
        },
        data: function () {
            return {
                assets: assets(),
                receipts: [],
                vouchertype: 2,
                document: 'all',
            }
        },
        methods: {
            loadReceipts() {
                Receipt.getReceiptsByVouchertype({
                    vouchertype: this.vouchertype,
                    document: this.document,
                }).then(({data}) => {
                    this.receipts = data.data;
                }).catch(error => console.log(error));
            },
            result(data) {
                if (data.successful) {
                    this.document = 'all';
                    if (data.document.length !== 0 && typeof data.document !== undefined) {
                        this.document = data.document;
                    }
                    this.vouchertype = data.voucher;
                    this.loadReceipts();
                } else {
                    this.receipts = [];
                }
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