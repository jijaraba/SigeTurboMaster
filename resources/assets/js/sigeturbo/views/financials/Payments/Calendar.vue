<template>
    <section class="payment-calendar">
        <ul class="col-100">
            <li v-for="payment in payments">
                <sigeturbo-payments-payment :payment="payment" banks="banks"
                                            :server-date="serverDate" :banks="banks"></sigeturbo-payments-payment>
            </li>
        </ul>
    </section>
</template>
<script>

    import Bank from '../../../models/Bank';
    import PaymentsPayment from '../../../views/financials/Payments/Payment/Payment';

    export default {

        props: [
            'payments',
            'serverDate'
        ],
        filters: {},
        components: {
            'sigeturbo-payments-payment': PaymentsPayment
        },
        data: function () {
            return {
                banks: [],
            }
        },
        methods: {},
        watch: {},
        created: function () {

            //Get Banks
            Bank.query('/api/v1/banks/', {})
                .then(({data}) => {
                    this.banks = data;
                })
                .catch(error => console.log(error));

        },
        mounted() {
        },
    }

</script>