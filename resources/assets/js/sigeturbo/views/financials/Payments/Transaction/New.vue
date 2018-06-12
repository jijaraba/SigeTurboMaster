<template>
    <section>
        <ul class="display-horizontal col-100">
            <li class="col-10 gutter-5 voucher">
                <input type="text" name="voucher" id="voucher" v-model="transaction.vouchertype" placeholder=""
                       @blur="changeVoucher(transaction.vouchertype)">
            </li>
            <li class="col-10 gutter-5">
                <input type="text" name="account" id="account" v-model="transaction.accounttype" placeholder="">
            </li>
            <li class="col-05 gutter-5">
                <select id="transactiontype" name="transactiontype" v-model="transaction.idtransactiontype" required>
                    <option :value="transactiontype.idtransactiontype" v-for="transactiontype in transactiontypes">{{
                        transactiontype.prefix }}
                    </option>
                </select>
            </li>
            <li class="col-07 gutter-5">
                <input type="text" name="document" id="document" v-model="transaction.document" placeholder="">
            </li>
            <li class="col-20 gutter-5">
                <input type="text" name="description" id="description" v-model="transaction.description"
                       placeholder="">
            </li>
            <li class="col-08 gutter-5">
                <input type="text" name="value" id="value" v-model="transaction.value" placeholder="">
            </li>
            <li class="col-10 gutter-5">
                <input type="text" name="date" id="date" v-model="transaction.date" placeholder="">
            </li>
            <li class="col-10 gutter-5">
                <input type="text" name="nit" id="nit" v-model="transaction.nit" placeholder="">
            </li>
            <li class="col-05 gutter-5">
                <input type="text" name="costcenter" id="costcenter" v-model="transaction.costcenter" placeholder="">
            </li>
            <li class="col-03 new">
                <div @click="newTransaction()">
                    <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                </div>
            </li>
            <li class="col-02 new">
                <i class="empty" aria-hidden="true"></i>
            </li>
        </ul>
    </section>
</template>
<script>

    import moment from 'moment'

    export default {

        props: [
            'payment',
            'transactiontypes',
        ],
        filters: {},
        components: {},
        data: function () {
            return {
                transaction: {
                    date: moment().format('YYYY-MM-DD')
                }
            }
        },
        methods: {
            changeVoucher(code) {

            }
        },
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>