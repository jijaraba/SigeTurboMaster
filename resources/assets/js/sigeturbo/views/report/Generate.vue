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

    import Exports from '../../models/Exports';
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
                Exports.getPartialReport('/api/v1/exports/reports/partials', {
                    filename: this.type,
                    format: format,
                    year: this.year,
                    period: this.period,
                    student: this.student,
                })
                    .then(({data}) => {
                        this.download = assets + '/export/' + data.file;
                        //Open New Window
                        setTimeout(function () {
                            this.generateText = 'Generado';
                            this.showDownload = true;
                            window.open(this.download, '_blank');
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
