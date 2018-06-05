<template>
    <div>
        <p>{{ $translate.text('sigeturbo.payment_status') | capitalize }}</p>
        <div class="container" :class="isPayment = 'is-payment'">
            <a href="parents/payments"
               id="payments">{{ paymentMessage }}</a>
        </div>
    </div>
</template>

<script>

    import Payment from "../../../models/Payment";
    import capitalize from "../../../filters/string/capitalize";

    export default {

        props: [
            "user"
        ],
        filters: {
          capitalize: capitalize
        },
        components: {},
        data: function () {
            return {
                isPayment: false,
                paymentMessage: ''
            }
        },
        methods: {},
        created() {

            Payment.getPaymentsPendingByUser({user: this.user})
                .then(({data}) => {
                    if (data.length > 0) {
                        this.isPayment = false;
                        this.paymentMessage = "Pendientes (" + this.data.length + ")";
                    } else {
                        this.isPayment = true;
                        this.paymentMessage = "Al Día";
                    }
                })
                .catch(error => console.log(error));

        }

    }

</script>
