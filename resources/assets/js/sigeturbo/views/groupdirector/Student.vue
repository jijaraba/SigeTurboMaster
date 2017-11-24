<template>
    <section class="sige-item">
        <ul class="display-horizontal col-100">
            <li class="col-05 check">
                <div>
                    <input type="checkbox">
                </div>
            </li>
            <li class="col-05 imagen">
                <div>
                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                </div>
            </li>
            <li class="col-50 gutter-5 name">
                <div>Informe {{ reportText }}</div>
            </li>
            <li class="col-20 gutter-5 action">
                <sigeturbo-report-generate :year="year" :period="period" :student="student"
                                           :type="type"></sigeturbo-report-generate>
            </li>
            <li class="col-20 gutter-5 action">
                <sigeturbo-report-enable :year="year" :period="period" :student="student"
                                         :type="type"></sigeturbo-report-enable>
            </li>
        </ul>
    </section>
</template>

<script>

    import GenerateReport from '../report/Generate';
    import EnableReport from '../report/Enable';

    export default {

        props: [
            'year',
            'period',
            'student',
            'type',
        ],
        components: {
            'sigeturbo-report-generate': GenerateReport,
            'sigeturbo-report-enable': EnableReport,
        },
        data: function () {
            return {
                reportText: 'Final'
            }
        },
        methods: {},
        created() {
            if (this.type == 'partialreport') {
                this.reportText = "Parcial"
            } else if (this.type == 'descriptivereport') {
                this.reportText = 'Descriptivo'
            } else {
                this.reportText = "Final"
            }
        }

    }

</script>
