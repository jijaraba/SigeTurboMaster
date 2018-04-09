<template>
    <button v-bind:class="(reportEnabled)?'btn enabled':'btn disabled'" @click="enable()">{{ enableText
        }}
    </button>
</template>

<script>

    import Report from '../../models/Report';

    export default {

        props: [
            'year',
            'period',
            'student',
            'type'
        ],
        data: function () {
            return {
                reportEnabled: false,
                enableText: 'Habilitar',
                download: ''
            }
        },
        methods: {
            enable() {
                this.enableText = 'Habilitando...';
                Report.save('/api/v1/reports/', {
                    year: this.year,
                    period: this.period,
                    user: this.student,
                    type: this.type,
                })
                    .then(({data}) => {
                        this.enableText = 'Habilitado';
                        this.reportEnabled = true;
                    })
                    .catch(error => {
                        this.enableText = 'Habilitar';
                        this.reportEnabled = false;
                        console.log(error);
                    });
            }
        },
        created() {
            Report.getReportByStudent('/api/v1/reports/getreportbystudent', {
                year: this.year,
                period: this.period,
                user: this.student,
                type: this.type,
            })
                .then(({data}) => {
                    if (data.length > 0) {
                        this.enableText = 'Habilitado';
                        this.reportEnabled = true;
                    }
                })
                .catch(error => {
                    this.enableText = 'Habilitar';
                    this.reportEnabled = false;
                    console.log(error);
                });
        }

    }

</script>
