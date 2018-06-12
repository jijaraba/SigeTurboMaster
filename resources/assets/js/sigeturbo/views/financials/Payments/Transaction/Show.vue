<template>
    <section>
        <section class="transaction-titles">
            <ul class="display-horizontal col-100">
                <li class="col-10 gutter-5 voucher">
                    COMPROBANTE
                </li>
                <li class="col-10 gutter-5">
                    CUENTA
                </li>
                <li class="col-05 gutter-5">
                    ASIENTO
                </li>
                <li class="col-07 gutter-5">
                    DOC.
                </li>
                <li class="col-20 gutter-5">
                    DESCRIPCIÓN
                </li>
                <li class="col-08 gutter-5">
                    VALOR
                </li>
                <li class="col-10 gutter-5">
                    FECHA
                </li>
                <li class="col-10 gutter-5">
                    NIT
                </li>
                <li class="col-05 gutter-5">
                    CENTRO
                </li>
                <li class="col-03 gutter-5 edit">
                </li>
                <li class="col-02 gutter-5 edit">
                </li>
            </ul>
        </section>
        <section v-for="transaction in transactions" class="transaction-edit">
            <sigeturbo-financials-transaction-edit :transaction="transaction"
                                                   :transactiontypes="transactiontypes"></sigeturbo-financials-transaction-edit>
        </section>
        <section class="transaction-new">
            <sigeturbo-financials-transaction-new :payment="payment"
                                                  :transactiontypes="transactiontypes"></sigeturbo-financials-transaction-new>
        </section>
        <section class="transaction-totals">
            <ul class="display-horizontal col-50">
                <li class="col-35"><span>DÉBITO</span> {{ debits | currency }}</li>
                <li class="col-35"><span>CRÉDITO</span> {{ credits | currency }}</li>
                <li class="col-30"><span>DIFERENCIA</span> {{ debits - credits | currency }}</li>
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
    import Transaction from "../../../../models/Transaction";

    export default {

        props: [
            'load',
            'payment',
        ],
        filters: {
            currency: currency
        },
        components: {
            'sigeturbo-financials-transaction-new': TransactionNew,
            'sigeturbo-financials-transaction-edit': TransactionEdit,
        },
        data: function () {
            return {
                transactions: [],
                transactiontypes: [],
            }
        },
        methods: {
            reloadTransactions() {
                //Get Transactions
                Transaction.getTransactionByPayment({
                    payment: this.payment
                }).then(({data}) => {
                    this.transactions = data;
                })
                    .catch(error => console.log(error));
            }
        },
        computed: {
            debits: function () {
                let debits = 0;
                if (this.transactions.length > 0) {
                    this.transactions.map(function (transaction, key) {
                        if (transaction.itransaction === 1) {
                            debits = debits + transaction.value;
                        }
                    }, this);

                }
                return debits;
            },
            credits: function () {
                let credits = 0;
                if (this.transactions.length > 0) {
                    this.transactions.map(function (transaction, key) {
                        if (transaction.itransaction === 2) {
                            credits = credits + transaction.value;
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

            //Reload Transaction
            this.reloadTransactions();
        },
        mounted() {
        },
    }

</script>