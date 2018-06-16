<template>
    <section :id="'accountingentry_' + accountingentry.idaccountingentry"
             v-bind:class="{ 'is-updated sigeturbo-animation-row': isUpdated } ">
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
            <li class="col-05 edit">
                <div @click="updateAccountingentry()">
                    <i class="fa fa-pen-square fa-lg" aria-hidden="true"> </i>
                </div>
            </li>
            <li class="col-05 delete">
                <div @click="deleteAccountingentry()">
                    <i class="fa fa-trash fa-lg" aria-hidden="true"> </i>
                </div>
            </li>
        </ul>
    </section>
</template>
<script>

    import Accountingentry from "../../../../models/Accountingentry";

    export default {

        props: [
            'accountingentry',
            'transactiontypes',
        ],
        filters: {},
        components: {},
        data: function () {
            return {
                isUpdated: false
            }
        },
        methods: {
            updateAccountingentry() {
                this.isUpdated = false;
                Accountingentry.update('/api/v1/accountingentries/', this.accountingentry.idaccountingentry, {
                    receipt: this.accountingentry.idreceipt,
                    accounttype: this.accountingentry.accounttype,
                    transactiontype: this.accountingentry.idtransactiontype,
                    costcenter: this.accountingentry.costcenter,
                    description: this.accountingentry.description,
                    value: this.accountingentry.value,
                    date: this.accountingentry.date,
                    nit: this.accountingentry.nit,
                }).then(({data}) => {
                    this.isUpdated = true;
                }).catch(error => console.log(error));
            },
            deleteAccountingentry() {
                Accountingentry.remove('/api/v1/accountingentries/', this.accountingentry.idaccountingentry)
                    .then(({data}) => {
                        this.$emit('reload', this.accountingentry.idreceipt);
                    }).catch(error => console.log(error));
            }
        },
        watch: {},
        created() {
            if (this.accountingentry.nit == 0) {
                this.accountingentry.nit = '';
            }
        },
        mounted() {
        },
    }

</script>