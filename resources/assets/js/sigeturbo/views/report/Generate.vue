<template>
    <ul class="display-horizontal col-100">
        <li class="col-50">
            <button v-bind:class="(showDownload)?'btn generated':'btn generate'" id="checkout"
                    @click="generate('pdf')">{{ generateText }}
            </button>
        </li>
        <li class="col-50 download">
            <a target="_blank" v-if="showDownload" :href="download">Download</a>
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
                download: ''
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
                        setTimeout(function () {
                            this.generateText = 'Generado';
                            this.showDownload = true;
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
