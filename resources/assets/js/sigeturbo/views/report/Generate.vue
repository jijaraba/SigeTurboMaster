<template>
    <ul class="display-horizontal col-100">
        <li class="col-100">
            <button v-bind:class="(showDownload)?'btn generated':'btn generate'" id="checkout"
                    @click="generate('pdf')">{{ generateText }}
            </button>
        </li>
    </ul>
</template>

<script>

    import Export from '../../models/Export';
    import assets from "../../core/utils";

    export default {

        props: [
            'year',
            'period',
            'student',
            'type',
        ],
        data: function () {
            return {
                showDownload: false,
                generateText: 'Visualizar',
                download: '',
                assets: assets()
            }
        },
        methods: {
            generate(format) {
                this.generateText = 'Generando...';
                let path = '';
                switch (this.type) {
                    case 'partialreport':
                        path = '/api/v1/exports/reports/partials';
                        break;
                    case 'finalreport':
                        path = '/api/v1/exports/reports/final';
                        break;
                    case 'descriptivereport':
                        path = '/api/v1/exports/reports/descriptive';
                        break;
                }

                Export.getReport(path, {
                    filename: this.type,
                    format: format,
                    year: this.year,
                    period: this.period,
                    student: this.student,
                })
                    .then(({data}) => {
                        this.download = this.assets + '/export/' + data.file;
                        let url = this.download
                        this.generateText = 'Generado';
                        this.showDownload = true;
                        //Open New Window
                        setTimeout(function () {
                            window.open(url, '_blank');
                        }, 1000);
                    })
                    .catch(error => {
                        this.showDownload = false;
                        this.generateText = 'Visualizar';
                        console.log(error);
                    });
            }
        },
        created() {
        }

    }

</script>
