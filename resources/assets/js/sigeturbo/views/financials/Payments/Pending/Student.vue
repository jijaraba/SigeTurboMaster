<template>
    <div>
        <section v-if="pending" class="sige-contained rounded-05 padding-20 bkg-red margin-bottom-10">
            <span style="color:white;font-size:0.9em">Por favor informar al padre de familia que debe comunicarse con <strong>Tesorería</strong></span>
        </section>
        <section v-if="!pending" class="sige-contained rounded-05 padding-20 bkg-green margin-bottom-10">
            <span style="color:white;font-size:0.9em">El estudiante no cuenta con notificaciones de <strong>Tesorería</strong></span>
        </section>
    </div>
</template>

<script>

    import Payment from "../../../../models/Payment";

    export default {

        props: [
            "student"
        ],
        components: {},
        data: function () {
            return {
                pending: false
            }
        },
        methods: {},
        created() {

            Payment.getPaymentsPendingByUser({user: this.student})
                .then(({data}) => {
                    if (data.length > 0) {
                        this.pending = true;
                    }
                })
                .catch(error => console.log(error));

        }

    }

</script>
