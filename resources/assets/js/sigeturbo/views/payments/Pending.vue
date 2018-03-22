<template>
    <section v-if="pending" class="sige-contained rounded-05 padding-20 margin-bottom-10" v-bind:class="{'bkg-red': pending,  'bkg-white': !pending}">
        <span style="color:white;font-size:0.9em">Por favor informar al padre de familia que debe comunicarse con <strong>Tesorería</strong></span>
    </section>
</template>

<script>

    import Payments from "../../models/Payments";

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

            Payments.getPaymentsPendingByUser({user: this.student})
                .then(({data}) => {
                    if(data.length > 0) {
                        this.pending = true;
                    }
                })
                .catch(error => console.log(error));

        }

    }

</script>
