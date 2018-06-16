<template>
    <section>
        <section class="transaction-titles">
            <ul class="display-horizontal col-100">
                <li class="col-10 gutter-5">
                    {{ $translate.text('sigeturbo.account') | uppercase }}
                </li>
                <li class="col-10 gutter-5">
                    {{ $translate.text('sigeturbo.entry') | uppercase }}
                </li>
                <li class="col-25 gutter-5">
                    {{ $translate.text('sigeturbo.description') | uppercase }}
                </li>
                <li class="col-13 gutter-5">
                    {{ $translate.text('sigeturbo.value') | uppercase }}
                </li>
                <li class="col-12 gutter-5">
                    {{ $translate.text('sigeturbo.date') | uppercase }}
                </li>
                <li class="col-10 gutter-5">
                    {{ $translate.text('sigeturbo.nit') | uppercase }}
                </li>
                <li class="col-10 gutter-5">
                    {{ $translate.text('sigeturbo.costcenter') | uppercase }}
                </li>
                <li class="col-05 gutter-5 edit">
                </li>
                <li class="col-05 gutter-5 edit">
                </li>
            </ul>
        </section>
        <section style="overflow-y: scroll; height: 163px">
            <section v-for="accountingentry in accountingentries" class="transaction-edit">
                <sigeturbo-financials-transaction-edit :accountingentry="accountingentry"
                                                       :transactiontypes="transactiontypes"
                                                       @reload="reloadAccountingentries"></sigeturbo-financials-transaction-edit>
            </section>
        </section>
        <section class="transaction-new">
            <sigeturbo-financials-transaction-new :receipt="receipt"
                                                  :transactiontypes="transactiontypes"
                                                  @reload="reloadAccountingentries"></sigeturbo-financials-transaction-new>
        </section>
        <section class="transaction-totals">
            <ul class="display-horizontal col-70">
                <li class="col-33"><span>{{ $translate.text('sigeturbo.debit') | uppercase }}</span> {{ debits |
                    currency }}
                </li>
                <li class="col-33"><span>{{ $translate.text('sigeturbo.debit') | uppercase }}</span> {{ credits |
                    currency }}
                </li>
                <li class="col-33"><span>{{ $translate.text('sigeturbo.difference') | uppercase }}</span> {{ debits -
                    credits | currency }}
                </li>
            </ul>
        </section>
        <div class="clearfix"></div>

    </section>
</template>
<script>

    import TransactionNew from './New';
    import TransactionEdit from './Edit';
    import currency from '../../../../filters/other/currency';
    import Transactiontype from "../../../../models/Transactiontype";
    import uppercase from "../../../../filters/string/uppercase";
    import Accountingentry from "../../../../models/Accountingentry";

    export default {

        props: [
            'load',
            'receipt',
        ],
        filters: {
            currency: currency,
            uppercase: uppercase,
        },
        components: {
            'sigeturbo-financials-transaction-new': TransactionNew,
            'sigeturbo-financials-transaction-edit': TransactionEdit,
        },
        data: function () {
            return {
                transactiontypes: [],
                accountingentries: [],
            }
        },
        methods: {
            reloadAccountingentries(receipt) {
                //Get Transactions
                Accountingentry.getAccountingentriesByReceipt({
                    receipt: receipt
                }).then(({data}) => {
                    this.accountingentries = data;
                }).catch(error => console.log(error));
            },
        },
        computed: {
            debits: function () {
                let debits = 0;
                if (this.accountingentries.length > 0) {
                    this.accountingentries.map(function (accountingentry, key) {
                        if (accountingentry.idtransactiontype === 1) {
                            debits = debits + parseFloat(accountingentry.value);
                        }
                    }, this);

                }
                return debits;
            },
            credits: function () {
                let credits = 0;
                if (this.accountingentries.length > 0) {
                    this.accountingentries.map(function (accountingentry, key) {
                        if (accountingentry.idtransactiontype === 2) {
                            credits = credits + parseFloat(accountingentry.value);
                        }
                    }, this);

                }
                return credits;
            },
        },
        watch: {},
        created() {
            //Get Paymenttypes
            Transactiontype.query('/api/v1/transactiontypes/', {})
                .then(({data}) => {
                    this.transactiontypes = data;
                })
                .catch(error => console.log(error));

            //Get Accountingentries
            if (this.load) {
                this.reloadAccountingentries(this.receipt.idreceipt);
            }

        },
        mounted() {
        },
    }

</script>