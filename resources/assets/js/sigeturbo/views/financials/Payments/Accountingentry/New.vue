<template>
    <section>
        <ul class="display-horizontal col-100">
            <li class="col-10 gutter-5">
                <input type="text" name="account" id="account" v-model="accountingentry.accounttype" placeholder="">
            </li>
            <li class="col-10 gutter-5 type">
                <select id="transactiontype" name="transactiontype" v-model="accountingentry.idtransactiontype"
                        required>
                    <option :value="transactiontype.idtransactiontype" v-for="transactiontype in transactiontypes">{{
                        transactiontype.prefix }}
                    </option>
                </select>
            </li>
            <li class="col-25 gutter-5">
                <input type="text" name="description" id="description" v-model="accountingentry.description"
                       placeholder="">
            </li>
            <li class="col-13 gutter-5">
                <input type="text" name="value" id="value" v-model="accountingentry.value" placeholder="">
            </li>
            <li class="col-12 gutter-5">
                <input type="text" name="date" id="date" v-model="accountingentry.date" placeholder="">
            </li>
            <li class="col-10 gutter-5">
                <input type="text" name="nit" id="nit" v-model="accountingentry.nit" placeholder="">
            </li>
            <li class="col-10 gutter-5">
                <input type="text" name="costcenter" id="costcenter" v-model="accountingentry.costcenter"
                       placeholder="">
            </li>
            <li class="col-05 new">
                <div @click="newAccountingentry()">
                    <i class="fa fa-plus-square fa-lg" aria-hidden="true"></i>
                </div>
            </li>
            <li class="col-05 new">
                <i class="empty" aria-hidden="true"></i>
            </li>
        </ul>
    </section>
</template>
<script>

    import moment from 'moment'
    import Accountingentry from "../../../../models/Model";

    export default {

        props: [
            'receipt',
            'transactiontypes',
        ],
        filters: {},
        components: {},
        data: function () {
            return {
                accountingentry: {
                    date: moment().format('YYYY-MM-DD')
                }
            }
        },
        methods: {
            newAccountingentry() {
                Accountingentry.save('/api/v1/accountingentries/', {
                    receipt: this.receipt.idreceipt,
                    accounttype: this.accountingentry.accounttype,
                    transactiontype: this.accountingentry.idtransactiontype,
                    costcenter: this.accountingentry.costcenter,
                    description: this.accountingentry.description,
                    value: this.accountingentry.value,
                    date: this.accountingentry.date,
                    nit: this.accountingentry.nit,
                }).then(({data}) => {
                    this.$emit('reload', this.receipt.idreceipt);
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