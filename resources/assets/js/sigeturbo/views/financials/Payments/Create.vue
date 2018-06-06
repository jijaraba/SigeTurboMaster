<template>
    <section class="options">
        <ul class="display-horizontal col-70 option-container">
            <li>
                <a @click="showMethodMassive()">
                    <img :src='assets+ "/img/modules/payment_massive.svg"' alt="Pago"/>
                    <span>PAGOS MASIVOS</span>
                </a>
            </li>
            <li>
                <a @click="showMethodIndividual()">
                    <img :src='assets + "/img/modules/payment_individual.svg"' alt="Pago"/>
                    <span>PAGOS INDIVIDUALES</span>
                </a>
            </li>
        </ul>
        <section v-if="showMassive" class="sige-main-modal" style="display: block;padding-top: 100px">
            <section class="modal-content" style="width: 800px">
                <div class="close" @click="closeMethodMassive()">
                    <i class="fas fa-window-close fa-lg"></i>
                </div>
                <section class="sige-payments-create-method massive">
                    <form @submit="paymentSaveMassive()" id="payment_massive">
                        <fieldset>
                            <legend>INFORMACIÓN DEL PAGO MASIVO</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-50 gutter-5">
                                    <span>AÑO ACADÉMICO</span>
                                    <select name="year" v-model="payment.academic">
                                        <option :value="year.idyear" v-for="year in years">{{ year.name }}</option>
                                    </select>
                                </li>
                                <li class="col-50 gutter-5">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-20">
                                    <span>AÑO</span>
                                    <input type="text" value="" v-model="payment.year">
                                </li>
                                <li class="col-20">
                                    <span>MES</span>
                                    <select name="month" v-model="payment.month">
                                        <option value="01">Enero</option>
                                        <option value="02">Febrero</option>
                                        <option value="03">Marzo</option>
                                        <option value="04">Abril</option>
                                        <option value="05">Mayo</option>
                                        <option value="06">Junio</option>
                                        <option value="07">Julio</option>
                                        <option value="08">Agosto</option>
                                        <option value="09">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                </li>
                                <li class="col-20">
                                    <span>DESCUENTO</span>
                                    <input type="text" v-model="payment.date1" value="" placeholder="Fecha Descuento">
                                </li>
                                <li class="col-20">
                                    <span>NORMAL</span>
                                    <input type="text" v-model="payment.date2" value="" placeholder="Fecha Normal">
                                </li>
                                <li class="col-20">
                                    <span>INTERÉS</span>
                                    <input type="text" v-model="payment.date3" value="" placeholder="Fecha Intereres">
                                </li>
                                <li class="col-30">
                                    <select name="month" v-model="payment.type" required>
                                        <option :value="concepttype.idconcepttype" v-for="concepttype in concepttypes">
                                            {{
                                            concepttype.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-70">
                                    <input type="text" v-model="payment.concept" value="" placeholder="Concepto de Pago"
                                           style="text-align: left">
                                </li>
                                <li class="col-100 border">
                        <textarea v-model="payment.exclude"
                                  placeholder="Especificar estudiantes a excluir separados por coma ',' y sin espacios."></textarea>
                                </li>
                            </ul>
                            <section class="info_generic">
                                <div>
                                    <i class="icon icon-info col-10" href="#"></i>
                                    <span class="col-90">La <strong>generación masiva</strong> asigna los pagos para los estudiantes matriculados al momento de su ejecución. Para estudiantes <strong>Matriculados</strong> después de la fecha de generación deben ser ingresados individualmente.</span>
                                </div>
                            </section>
                            <button value="Save" class="btn btn-aquamarine" type="submit">Generar</button>
                        </fieldset>
                    </form>
                </section>
            </section>
        </section>
        <template v-if="showIndividual">
            <sigeturbo-payment-create-individual @close="close" :payment="payment" :years="years"
                                                 :concepttypes="concepttypes"
                                                 :months="months"></sigeturbo-payment-create-individual>

        </template>
    </section>
</template>
<script>

    import moment from 'moment';
    import assets from '../../../core/utils';
    import uppercase from '../../../filters/string/uppercase';
    import capitalize from '../../../filters/string/capitalize';
    import Concepttype from "../../../models/Concepttype";
    import Year from '../../../models/Year';
    import PaymentCreateIndividual from "../../../views/financials/Payments/Create/Invidivual";

    export default {

        props: [],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize
        },
        components: {
            'sigeturbo-payment-create-individual': PaymentCreateIndividual
        },
        data: function () {
            return {
                assets: assets(),
                showIndividual: false,
                showMassive: false,
                payment: {
                    academic: 2017,
                    year: moment().format('YYYY'),
                    month: moment().format('MM'),
                    day: moment().format('DD'),
                    date1: moment([moment().format('YYYY'), parseInt(moment().format('MM') - 1), 10]).format('YYYY-MM-DD'),
                    date2: moment([moment().format('YYYY'), parseInt(moment().format('MM') - 1), moment().daysInMonth()]).format('YYYY-MM-DD'),
                    date3: moment([moment().format('YYYY'), parseInt(moment().format('MM') - 1), moment().daysInMonth()]).format('YYYY-MM-DD'),
                    date4: moment([moment().format('YYYY'), parseInt(moment().format('MM') - 1), moment().daysInMonth()]).format('YYYY-MM-DD'),
                    type: 3,
                    package: 1,
                    value1: 0,
                    value2: 0,
                    value3: 0,
                    value4: 0,
                    value1: 0,
                    concept: 'PENSIÓN',
                    result: '',
                },
                concepttypes: [],
                years: [],
                months: [],
            }
        },
        methods: {
            uppercase: uppercase,
            capitalize: capitalize,
            showMethodMassive() {
                this.showMassive = true;
            },
            showMethodIndividual() {
                this.showIndividual = true;
            },
            close() {
                this.showIndividual = false;
                this.showMassive = false;
            },

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
                    this.payment.academic = data.idyear;
                })
                .catch(error => console.log(error));

            //Get Concepttypes
            Concepttype.query('/api/v1/concepttypes', {})
                .then(({data}) => {
                    this.concepttypes = data;
                })
                .catch(error => console.log(error));

            //Get Months
            moment.locale('es', {
                months: [
                    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO',
                    'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
                ]
            });
            this.months = moment.months('es');

        },
        mounted() {
        },
    }

</script>