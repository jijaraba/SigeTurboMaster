<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 800px;">
            <div class="close" @click="close()">
                <i class="fas fa-window-close fa-lg"></i>
            </div>
            <section class="sige-wizard-container padding-30">
                <header>
                    <h4>{{ $translate.text('sigeturbo.general') | uppercase }}</h4>
                </header>
                <section class="body">
                    <form @submit="paymentSaveIndividual($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/payment_individual_welcome.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(1)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.start') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-1" data-step="1">
                            <legend>INFORMACIÓN DEL PAGO INVIDUAL</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.profession') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el <strong>Tipo de Identificación, El Número y el Lugar de Expedición</strong> del documento del usuario
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/payment_individual.svg"' alt=""/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>AÑO ACADÉMICO</span>
                                    <select name="year" v-model="payment.academic">
                                        <option :value="year.idyear" v-for="year in years">{{ year.name }}</option>
                                    </select>
                                </li>
                                <li class="col-40 gutter-5">
                                    <span>CONCEPTO</span>
                                    <select name="month" v-model="payment.type" required>
                                        <option :value="concepttype.idconcepttype" v-for="concepttype in concepttypes">
                                            {{concepttype.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>CÓDIGO</span>
                                    <input type="text" value="" v-model="payment.student"
                                           placeholder="Código Estudiante"
                                           @blur="searchStudent()">
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(2)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-2" data-step="2">
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.profession') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el <strong>Tipo de Identificación, El Número y el Lugar de Expedición</strong> del documento del usuario
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/payment_individual.svg"' alt=""/>
                                </li>
                                <li class="col-50 gutter-5">
                                    <span>PAQUETE</span>
                                    <select name="month" v-model="payment.package">
                                        <option :value="pack.idpackage" v-for="(pack, index) in packages"
                                                :selected="index == 0 ? 'selected':''">
                                            {{pack.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-50 gutter-5">
                                    <span>DESCRIPCIÓN DEL CONCEPTO</span>
                                    <input type="text" v-model="payment.concept" value="" placeholder="Concepto de Pago"
                                           style="text-align: left">
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(3)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-3" data-step="3">
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.profession') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el <strong>Tipo de Identificación, El Número y el Lugar de Expedición</strong> del documento del usuario
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/payment_individual.svg"' alt=""/>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>AÑO</span>
                                    <input type="number" value="" v-model="payment.year" min="1995">
                                </li>
                                <li class="col-20 gutter-5">
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
                                <li class="col-20 gutter-5">
                                    <span>DESCUENTO</span>
                                    <input type="text" v-model="payment.date1" value="" placeholder="Fecha Descuento">
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>NORMAL</span>
                                    <input type="text" v-model="payment.date2" value="" placeholder="Fecha Normal">
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>INTERÉS</span>
                                    <input type="text" v-model="payment.date3" value="" placeholder="Fecha Intereres">
                                </li>
                                <li class="col-33 gutter-5">
                                    <span>VALOR CON DESCUESTO</span>
                                    <input type="text" v-model="payment.value1" value="" placeholder="Valor Descuento">
                                </li>
                                <li class="col-33 gutter-5">
                                    <span>VALOR NORMAL</span>
                                    <input type="text" v-model="payment.value2" value="" placeholder="Valor Normal">
                                </li>
                                <li class="col-33 gutter-5">
                                    <span>VALOR CON INTERÉS</span>
                                    <input type="text" v-model="payment.value3" value="" placeholder="Valor Intereres">
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(4)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-4" data-step="4">
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.profession') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el <strong>Tipo de Identificación, El Número y el Lugar de Expedición</strong> del documento del usuario
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/payment_individual.svg"' alt=""/>
                                </li>
                                <li class="col-100 guutter border">
                                    <span>RESULTADO</span>
                                    <textarea v-model="payment.result"></textarea>
                                </li>
                                <li class="col-100">
                                    <input @click="savePayment()" type="button" class="btn btn-aquamarine"
                                           value="Generar">
                                </li>
                            </ul>
                        </fieldset>
                    </form>
                </section>
                <footer>
                    <ul class="display-horizontal col-100">
                        <li class="col-35 previous"></li>
                        <li class="col-30 steps">
                            <ul class="display-horizontal col-100">
                                <li @click="setStep(1)">
                                    <div :class="[stepSelected == 1 ? 'selected' : '']">1</div>
                                </li>
                                <li @click="setStep(2)">
                                    <div :class="[stepSelected == 2 ? 'selected' : '']">2</div>
                                </li>
                                <li @click="setStep(3)">
                                    <div :class="[stepSelected == 3 ? 'selected' : '']">3</div>
                                </li>
                                <li @click="setStep(4)">
                                    <div :class="[stepSelected == 4 ? 'selected' : '']">4</div>
                                </li>
                            </ul>
                        </li>
                        <li class="col-35 next">

                        </li>
                    </ul>
                </footer>
            </section>
        </section>
    </section>
</template>
<script>

    import moment from 'moment';
    import uppercase from '../../../../filters/string/uppercase';
    import paymentTotal from '../../../../filters/math/paymentTotal';
    import Package from "../../../../models/Package";
    import Enrollment from "../../../../models/Enrollment";
    import Cost from "../../../../models/Cost";
    import Payment from "../../../../models/Payment";
    import assets from "../../../../core/utils";
    import capitalize from "../../../../filters/string/capitalize";

    export default {

        props: [
            'payment',
            'years',
            'concepttypes',
            'months',
        ],
        filters: {
            uppercase: uppercase,
            paymentTotal: paymentTotal,
            capitalize: capitalize,
        },
        components: {},
        data: function () {
            return {
                assets: assets(),
                studentWithScholarship: false,
                packages: [],
                user: [],
                costs: [],
                steps: 4,
                stepSelected: 0
            }
        },
        methods: {
            searchStudent() {
                if (typeof this.payment.student !== 'undefined' && this.payment.student !== '' && !isNaN(parseInt(this.payment.student))) {
                    //Get Enrollment By Student
                    Enrollment.getEnrollmentLatestByStudentWithCost({
                        student: this.payment.student,
                        year: this.payment.academic,
                    }).then(({data}) => {
                            if (typeof data.iduser !== 'undefined') {
                                //User
                                this.user = data;
                                this.payment.iduser = data.iduser;
                                this.payment.firstname = data.firstname;
                                this.payment.lastname = data.lastname;
                                this.payment.gender = data.idgender;
                                this.payment.scholarship = parseInt(data.scholarship);

                                //Scholarship
                                if (this.payment.scholarship == 1) {
                                    swal(uppercase(this.$translate.text('sigeturbo.warning')), 'Estudiante con Beca del ' + (this.payment.scholarship * 100) + '%', 'warning');
                                }
                                if (parseFloat(this.payment.scholarship) > 0) {
                                    this.studentWithScholarship = true;
                                } else {
                                    this.studentWithScholarship = false;
                                }
                                //Get Costs
                                this.getCosts(this.payment.package);

                            } else {
                                swal(uppercase(this.$translate.text('sigeturbo.error')), 'No existe el estudiante', 'error');
                            }
                        }
                    ).catch(error => console.log(error));

                }
            },
            getCosts(pack) {
                //Get Costs By Package,Grade And Type
                Cost.getCostsByPackage({
                    year: this.payment.academic,
                    package: pack,
                    type: this.payment.type,
                    grade: this.user.idgrade,
                }).then(({data}) => {
                    this.costs = data;
                    //Config Values
                    this.payment.value1 = paymentTotal(this.costs, 'normal');
                    this.payment.value2 = paymentTotal(this.costs, 'normal') - paymentTotal(this.costs, 'discount');
                    this.payment.value3 = paymentTotal(this.costs, 'normal') + paymentTotal(this.costs, 'expired');
                    this.payment.value4 = paymentTotal(this.costs, 'normal');
                    //Set Concept
                    this.setConcept(this.payment.concept);


                }).catch(error => console.log(error));
            },
            setConcept(concept) {
                if (typeof this.user.iduser !== "undefined") {
                    if (this.payment.type == 2) {
                        if (this.studentWithScholarship == true) {
                            this.payment.result = concept + ' ' + this.months[parseInt(moment().format('MM') - 1)] + ' BECA DEL ' + (this.payment.scholarship * 100) + '%' + ' (' + this.payment.iduser + ' - ' + this.payment.firstname.toUpperCase() + ')';
                        } else {
                            this.payment.result = concept + ' ' + this.months[parseInt(moment().format('MM') - 1)] + ' (' + this.payment.iduser + ' - ' + this.payment.firstname.toUpperCase() + ')'
                        }
                    } else {
                        this.payment.result = concept + ' ' + this.months[parseInt(moment().format('MM') - 1)] + ' (' + this.payment.iduser + ' - ' + this.payment.firstname.toUpperCase() + ')'
                    }
                }
            },
            getPackages() {
                //Get Packages By Concepttype
                Package.getPackagesByConcept({
                    concept: this.payment.type
                }).then(({data}) => {
                    this.packages = data;
                    this.payment.package = this.packages[0].idpackage
                }).catch(error => console.log(error));
            },
            savePayment() {
                //Save Payment Individual
                Payment.savePaymentIndividual({
                    student: this.payment.student,
                    firstname: this.payment.firstname,
                    lastname: this.payment.lastname,
                    gender: this.payment.gender,
                    scholarship: this.payment.scholarship,
                    type: this.payment.type,
                    package: this.payment.package,
                    concept: this.payment.concept,
                    date1: this.payment.date1,
                    date2: this.payment.date2,
                    date3: this.payment.date3,
                    date4: this.payment.date4,
                    value1: this.payment.value1,
                    value2: this.payment.value2,
                    value3: this.payment.value3,
                    value4: this.payment.value4,
                    year: this.payment.year,
                    month: this.payment.month,
                    month_name: this.months[parseInt(this.payment.month - 1)],
                }).then(({data}) => {
                    this.packages = data;
                    this.payment.package = this.packages[0].idpackage
                }).catch(error => console.log(error));
            },
            setStep(step) {
                for (let i = 0; i <= this.steps; i++) {
                    document.getElementById('step-' + i).style.display = "none";
                }
                document.getElementById('step-' + step).style.display = "block";
                //Step Selected
                this.stepSelected = step;
            },
            close() {
                this.$emit('close');
            }
        },
        watch: {
            'payment.type': function (newType) {
                this.getPackages();
                this.payment.concept = this.concepttypes[newType - 1].name.toUpperCase()
            },
            'payment.year': function (newYear) {
                this.payment.date1 = moment([newYear, parseInt(this.payment.month - 1), 10]).format('YYYY-MM-DD');
                this.payment.date2 = moment([newYear, parseInt(this.payment.month - 1), moment(newYear + "-" + this.payment.month, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
                this.payment.date3 = moment([newYear, parseInt(this.payment.month - 1), moment(newYear + "-" + this.payment.month, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
                this.payment.date4 = moment([newYear, parseInt(this.payment.month - 1), moment(newYear + "-" + this.payment.month, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
            },
            'payment.month': function (newMonth) {
                this.payment.date1 = moment([this.payment.year, parseInt(newMonth - 1), 10]).format('YYYY-MM-DD');
                this.payment.date2 = moment([this.payment.year, parseInt(newMonth - 1), moment(this.payment.year + "-" + newMonth, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
                this.payment.date3 = moment([this.payment.year, parseInt(newMonth - 1), moment(this.payment.year + "-" + newMonth, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
                this.payment.date4 = moment([this.payment.year, parseInt(newMonth - 1), moment(this.payment.year + "-" + newMonth, "YYYY-MM").daysInMonth()]).format('YYYY-MM-DD');
            },
            'payment.academic': function (newAcademic) {
                this.searchStudent();
            },
            'payment.concept': function (newConcept) {
                //Set Concept
                this.setConcept(newConcept);
            },
            'payment.package': function (newPackage) {
                //Get Costs
                this.getCosts(newPackage);
            }
        },
        created() {
            //Get Packages
            this.getPackages()
        },
        mounted() {
        },
    }

</script>