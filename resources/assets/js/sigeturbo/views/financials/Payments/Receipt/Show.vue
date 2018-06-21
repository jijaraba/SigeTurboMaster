<template>
    <section>
        <ul id="receipts-list" class="display-horizontal col-100">
            <template>
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
                        <li class="col-05 document">
                            <div>{{ receipt.document }}</div>
                        </li>
                        <li class="col-25 vouchertype">
                            <div>{{ receipt.vouchertype | titlecase }}: {{ receipt.description | titlecase }}</div>
                        </li>
                        <li class="payments col-30">
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
                        <li class="col-15 pending">
                            <div>{{ receipt.receiptpayments | chargeTotalRealValue | currency }}</div>
                        </li>
                        <li class="col-05 receipt">
                            <div @click="showAccountingentryForm()">
                                <i class="fas fa-receipt fa-2x"></i>
                            </div>
                        </li>
                        <li class="col-05 export">
                            <div @click="getReceiptReport('cash_receipt','pdf')">
                                <i class="fas fa-file-pdf fa-2x"></i>
                            </div>
                        </li>
                    </ul>
                </li>
            </template>
        </ul>
        <section v-if="showAccountingentry" class="sige-main-modal" style="display: block;padding-top: 100px">
            <section class="modal-content" style="width: 900px;">
                <div class="close" @click="closeAccountingentryForm()">
                    <i class="fas fa-window-close fa-lg"></i>
                </div>
                <section class="padding-30">
                    <h4>{{ $translate.text('sigeturbo.accountingentries') | uppercase }}</h4>
                    <section class="sige-financials-transactions">
                        <section class="payments">
                            <section class="transactions">
                                <sigeturbo-accountingentry-show :load="load"
                                                                :receipt="receipt"></sigeturbo-accountingentry-show>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</template>
<script>

    import assets from "../../../../core/utils";
    import PaymentsPayment from '../../../../views/financials/Payments/Payment/Payment';
    import AccountingentryShow from '../../../../views/financials/Payments/Accountingentry/Show';
    import {chargeTotalRealValue} from "../../../../filters/payment/charge";
    import currency from "../../../../filters/other/currency";
    import uppercase from "../../../../filters/string/uppercase";
    import titlecase from "../../../../filters/string/titlecase";
    import Export from "../../../../models/Export";


    export default {

        props: [
            'receipt',
            'banks',
            'serverDate',
        ],
        filters: {
            chargeTotalRealValue: chargeTotalRealValue,
            currency: currency,
            uppercase: uppercase,
            titlecase: titlecase,
        },
        components: {
            'sigeturbo-payments-payment': PaymentsPayment,
            'sigeturbo-accountingentry-show': AccountingentryShow,
        },
        data: function () {
            return {
                showAccountingentry: false,
                assets: assets(),
                load: true,
            }
        },
        methods: {
            showAccountingentryForm() {
                this.showAccountingentry = true;
            },
            closeAccountingentryForm() {
                this.showAccountingentry = false;
            },
            getReceiptReport(filename, format) {
                Export.getReceiptReport({
                    filename: filename,
                    format: format,
                    document: this.receipt.document,
                    vouchertype: this.receipt.idvouchertype,
                }).then(({data}) => {
                    this.download = this.assets + '/export/' + data.file;
                    let url = this.download
                    //Open New Window
                    setTimeout(function () {
                        window.open(url, '_blank');
                    }, 1000);
                }).catch(error => console.log(error));
            }
        },
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>