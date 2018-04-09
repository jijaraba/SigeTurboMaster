<template>
    <section class="sige-modal">
        <section class="modal-content" style="width: 800px">
            <section class="sige-financials-transactions">
                <header>
                    <h4>DETALLE DEL PAGO #{{ payment.idpayment }}</h4>
                    <div class="close" @click="closeReceipt()">
                        <span class="fa fa-times" aria-hidden="true"></span>
                    </div>
                </header>
                <section class="payments">
                    <div class="payment-title" @click="showPayment()">
                        <span>{{ payment.concept2 }}</span>
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </div>
                    <section class="transactions" :id='"show_payment_"'>
                        <!--<sige-turbo-financials-transactions load="load"
                                                            payment="payment"></sige-turbo-financials-transactions>-->
                    </section>
                </section>
            </section>
        </section>
    </section>
</template>
<script>

    export default {

        props: [
            'payment',
            'showReceipt'
        ],
        filters: {},
        components: {},
        data: function () {
            return {}
        },
        methods: {
            closeReceipt(){
                this.$emit('close', false)
            }
        },
        watch: {},
        created() {

        },
        mounted() {
        },
    }

</script>