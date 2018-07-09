<template>
    <section>
        <section class="options">
            <ul class="display-horizontal col-70 option-container">
                <li>
                    <a @click="showOptionPackage()">
                        <img :src='assets+ "/img/modules/payment_massive.svg"' alt="Pago"/>
                        <span>PAQUETES DE COBRO</span>
                    </a>
                </li>
                <li>
                    <a @click="showOptionCost()">
                        <img :src='assets + "/img/modules/payment_individual.svg"' alt="Pago"/>
                        <span>COSTOS POR GRADO</span>
                    </a>
                </li>
            </ul>
        </section>
        <section v-if="showCost" class="sige-main-modal" style="display: block;padding-top: 100px">
            <section class="modal-content" style="width: 800px; height: 400px">
                <div class="close" @click="closeOptionCost()">
                    <i class="fas fa-window-close fa-lg"></i>
                </div>
                <section class="sige-wizard-container padding-30">
                    <h4>{{ $translate.text('sigeturbo.costs') | uppercase }}</h4>
                    <section>
                        <sigeturbo-packages-create-cost :years="years" :year="cost.academic"
                                                        :grades="grades"
                                                        :concepttypes="concepttypes"></sigeturbo-packages-create-cost>
                    </section>
                </section>
            </section>
        </section>
    </section>
</template>
<script>

    import {assets} from '../../../core/utils';
    import uppercase from '../../../filters/string/uppercase';
    import capitalize from '../../../filters/string/capitalize';
    import PackageCreateCost from "../../../views/financials/Packages/Create/Cost";
    import Year from "../../../models/Year";
    import Grade from "../../../models/Model";
    import Concepttype from "../../../models/Concepttype";

    export default {

        props: [],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize
        },
        components: {
            'sigeturbo-packages-create-cost': PackageCreateCost
        },
        data: function () {
            return {
                assets: assets(),
                showCost: false,
                years: [],
                grades: [],
                concepttypes: [],
                cost: {
                    academic: 2017
                }
            }
        },
        methods: {
            showOptionCost() {
                this.showCost = true;
            },
            closeOptionCost() {
                this.showCost = false;
            }
        },
        watch: {},
        created() {

            //Get Years
            Year.query('/api/v1/years/', {})
                .then(({data}) => {
                    this.years = data;
                })
                .catch(error => console.log(error));

            //Get Current Year
            Year.getCurrentYear({})
                .then(({data}) => {
                    this.cost.academic = data.idyear;
                })
                .catch(error => console.log(error));

            //Get Grades
            Grade.query('/api/v1/grades/', {})
                .then(({data}) => {
                    this.grades = data;
                })
                .catch(error => console.log(error));

            //Get Concepttypes
            Concepttype.query('/api/v1/concepttypes/', {})
                .then(({data}) => {
                    this.concepttypes = data;
                })
                .catch(error => console.log(error));

        },
        mounted() {
        },
    }

</script>