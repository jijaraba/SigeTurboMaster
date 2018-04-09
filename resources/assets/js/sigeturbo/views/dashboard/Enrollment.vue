<template>
    <section v-bind:class="statusClass" class="dashboard square">
        <ul class="display-horizontal col-100">
            <li class="col-70 values">
                <div class="value">{{ amount }}</div>
                <div class="name">{{ $translate.text('sigeturbo.' + status) | uppercase }}</div>
            </li>
            <li class="col-30 imagen">
                <i class="fa fa-users" aria-hidden="true"></i>
            </li>
        </ul>
    </section>
</template>
<script>

    import Enrollment from '../../models/Enrollment';
    import uppercase from '../../filters/string/uppercase';

    export default {

        props: [
            'statusschooltype',
        ],
        filters: {
            uppercase: uppercase
        },
        components: {},
        data: function () {
            return {
                amount: 0,
                status: 'actives',
                statusClass: 'bkg-green'
            }
        },
        methods: {},
        watch: {},
        created: function () {

            //Select Status
            switch (this.statusschooltype) {
                case 1:
                    this.status = 'actives';
                    this.statusClass = 'bkg-green';
                    break;
                case 6:
                    this.status = 'internship';
                    this.statusClass = 'bkg-blue';
                    break;
                case 11:
                    this.status = 'assistant';
                    this.statusClass = 'bkg-yellow';
                    break;
                case 12:
                    this.status = 'pending';
                    this.statusClass = 'bkg-yellow';
                    break;
                case 4:
                    this.status = 'retired';
                    this.statusClass = 'bkg-red';
                    break;
                case 13:
                    this.status = 'psychology';
                    this.statusClass = 'bkg-purple';
                    break;
            }

            Enrollment.getEnrollmentsByStatus('/api/v1/enrollments/getenrollmentsbystatus', {
                status: this.status
            })
                .then(({data}) => {
                    if (data.amount > 0) {
                        this.amount = data.amount;
                    }
                })
                .catch(error => console.log(error));
        },
        mounted() {
        },
    }

</script>