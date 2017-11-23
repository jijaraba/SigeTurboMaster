<template>
    <ul class="display-horizontal col-100">
        <li class="col-50">
            <a v-bind:class="(showDownload)?'btn generated':'btn generate'" id="checkout"
               @click="generate('partialreport','pdf')">{{ generateText }}</a>
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
            'student',
        ],
        data: function () {
            return {
                showDownload: false,
                generateText: 'Generar',
                download: ''
            }
        },
        methods: {
            generate(filename, format) {
                this.generateText = 'Generando...';
                Exports.getPartialReport('/api/v1/exports/reports/partials', {
                    filename: filename,
                    format: format,
                    year: 2017,
                    period: 1,
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
                        this.generateText = 'Generar';
                        console.log(error);
                    });
            }
        },
        created() {
        }

    }

</script>
