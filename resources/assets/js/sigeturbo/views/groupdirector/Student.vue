<template>
    <section>
        <ul class="display-horizontal col-20">
            <li class="col-50">
                <sigeturbo-report-generate :student="student"></sigeturbo-report-generate>
            </li>
            <li class="col-50">
                <sigeturbo-report-enable :student="student" type="partialreport"></sigeturbo-report-enable>
            </li>
        </ul>
    </section>
</template>

<script>

    import GenerateReport from '../report/Generate';
    import EnableReport from '../report/Enable';

    export default {

        props: [
            'student',
        ],
        components: {
            'sigeturbo-report-generate': GenerateReport,
            'sigeturbo-report-enable': EnableReport,
        },
        data: function () {
            return {}
        },
        methods: {},
        created() {
        }

    }

</script>
