<template>
    <button v-bind:class="(reportEnabled)?'btn enabled':'btn disabled'" @click="enable('partialreport')">{{ enableText
        }}
    </button>
</template>

<script>

    import Reports from '../../models/Reports';

    export default {

        props: [
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
            enable(reporttype) {
                this.enableText = 'Habilitando...';
                Reports.save('/api/v1/reports/', {
                    year: 2017,
                    period: 1,
                    user: this.student,
                    type: reporttype,
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
            Reports.getReportByStudent('/api/v1/reports/getreportbystudent', {
                year: 2017,
                period: 1,
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
