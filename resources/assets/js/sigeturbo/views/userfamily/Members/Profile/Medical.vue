<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 750px;">
            <div class="close" @click="close()">
                <i class="fas fa-window-close fa-lg"></i>
            </div>
            <section class="sige-wizard-container padding-30">
                <header>
                    <h4>{{ $translate.text('sigeturbo.medical') | uppercase }}</h4>
                </header>
                <section class="body">
                    <form @submit="updateProfileMedical($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/profile_info_health_welcome.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(1)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.start') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-1" data-step="1">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 1</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.blood_type') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar <strong>Tipo de Sangre</strong> del estudiante para el cual se está actualizando la información en el Sistema de Información
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.blood_type') | uppercase }}</span>
                                    <select v-model="preregistration.idbloodtype" required>
                                        <option :value="bloodtype.idbloodtype" v-for="bloodtype in bloodtypes">{{
                                            bloodtype.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(2)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-2" data-step="2">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 2</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.medical_insurance') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Proporcionar la información de <strong>EPS, Medicina Prepagada y Número de Poliza</strong> con los que cuenta el estudiante para el cual se está actualizando la información
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.medical_insurance') | uppercase }}</span>
                                    <select v-model="preregistration.idmedicalinsurance">
                                        <option :value="medicalinsurance.idmedicalinsurance"
                                                v-for="medicalinsurance in medicalinsurances">{{
                                            medicalinsurance.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.medical_prepaid') | uppercase }}</span>
                                    <select v-model="preregistration.idprepaidmedical">
                                        <option :value="prepaidmedical.idprepaidmedical"
                                                v-for="prepaidmedical in prepaidmedicals">{{
                                            prepaidmedical.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.policy_number') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.policynumber"
                                           :title="$translate.text('sigeturbo.policy_number') | uppercase"
                                           :placeholder="$translate.text('sigeturbo.policy_number') | uppercase"/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(3)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-3" data-step="3">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 3</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.medical_treatment') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar si el estudiante tiene algún tratamiento médico que considere que la institución deba conocer
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.medical_treatment') | uppercase }}</span>
                                    <select name="medicaltreatment" v-model="preregistration.medicaltreatment" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>
                                </li>
                                <li class="col-70 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.medical_treatment_description') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.medicaltreatmentdescription"
                                           :title="$translate.text('sigeturbo.medical_treatment_description') | uppercase"
                                           :placeholder="$translate.text('sigeturbo.medical_treatment_description') | uppercase"/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.equal_treatment') | uppercase }}</span>
                                    <select name="equaltreatment"
                                            v-model="preregistration.equaltreatment" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>

                                </li>
                                <li class="col-100">
                                    <input @click="setStep(4)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-4" data-step="4">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 4</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.take_medication') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Indicar si el estudiante para el cual se está ingresando la información en el Sistema de Información toma algún tipo de medicamento
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.take_medication') | uppercase }}</span>
                                    <select name="takemedication"
                                            v-model="preregistration.takemedication" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>

                                </li>
                                <li class="col-40 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.medication_description') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.medicationdescription"
                                           :title="$translate.text('sigeturbo.medication_description') | uppercase"
                                           :placeholder="$translate.text('sigeturbo.medication_description') | uppercase"/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.why_take_medication') | uppercase }}</span>
                                    <textarea rows="2" name="whytakemedication" id="whytakemedication"
                                              v-model="preregistration.whytakemedication"
                                              :placeholder="$translate.text('sigeturbo.why_take_medication') | uppercase"></textarea>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.dose') | uppercase }}</span>
                                    <textarea rows="2" name="dose" id="dose" v-model="preregistration.dose"
                                              :placeholder="$translate.text('sigeturbo.dose') | uppercase"></textarea>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(5)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-5" data-step="5">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 5</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.is_allergic') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar en esta opción si el estudiante sufre de algún tipo de alergia. En caso de ser afirmativo, por favor indicar especificar el tipo de alergia
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-20 gutter-5" id="isallergic_container">
                                    <span>{{ $translate.text('sigeturbo.is_allergic') | uppercase }}</span>
                                    <select name="isallergic" v-model="preregistration.isallergic" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>
                                </li>
                                <li class="col-80 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.specify_allergic') | uppercase }}</span>
                                    <input type="text" id="specifyallergic"
                                           v-model="preregistration.specifyallergic"
                                           :title="$translate.text('sigeturbo.specify_allergic') | uppercase"
                                           :placeholder="$translate.text('sigeturbo.specify_allergic') | uppercase"/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(6)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-6" data-step="6">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 6</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.suffered_illness') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar si el estudiante sufre de algún tipo de enfermedad o condicion médica que la institución deba conocer
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-40 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.suffered_illness') | uppercase }}</span>
                                    <select name="sufferedillness"
                                            v-model="preregistration.sufferedillness" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>
                                </li>
                                <li class="col-60 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.suffered_illness_description') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.sufferedillnessdescription"
                                           :title="$translate.text('sigeturbo.suffered_illness_description') | uppercase"
                                           :placeholder="$translate.text('sigeturbo.suffered_illness_description') | uppercase"/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(7)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-7" data-step="7">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 7</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.doctor_name') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el <strong>nombre completo del pediatra y el número de contacto</strong> en caso de que el estudiante cuente con alguno.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-60 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.doctor_name') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.doctorname"
                                           :placeholder="$translate.text('sigeturbo.doctor_name') | uppercase"/>
                                </li>
                                <li class="col-40 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.doctor_phone') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.doctorphone"
                                           :placeholder="$translate.text('sigeturbo.doctor_phone') | uppercase"/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(8)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-8" data-step="8">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 8</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.psychologicalsupport') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar si el estudiante tiene <strong>Apoyo Psicológico</strong> que la institución deba conocer.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.psychological_support') | uppercase }}</span>
                                    <select name="psychologicalsupport"
                                            v-model="preregistration.psychologicalsupport" required>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                    </select>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(9)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-9" data-step="9">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 9</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.save') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Confirmar la actualización de la <strong>información médica</strong> del estudiante en nuestro sistema de informacuón (SigeTurbo). Si la información está completa por favor proceder a dar clic en el botón guardar
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <input class="btn btn-aquamarine" type="submit"
                                           :value="$translate.text('sigeturbo.save') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                    </form>
                </section>
                <footer>
                    <ul class="display-horizontal col-100">
                        <li class="col-25 previous"></li>
                        <li class="col-50 steps">
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
                                <li @click="setStep(5)">
                                    <div :class="[stepSelected == 5 ? 'selected' : '']">5</div>
                                </li>
                                <li @click="setStep(6)">
                                    <div :class="[stepSelected == 6 ? 'selected' : '']">6</div>
                                </li>
                                <li @click="setStep(7)">
                                    <div :class="[stepSelected == 7 ? 'selected' : '']">7</div>
                                </li>
                                <li @click="setStep(8)">
                                    <div :class="[stepSelected == 8 ? 'selected' : '']">8</div>
                                </li>
                                <li @click="setStep(9)">
                                    <div :class="[stepSelected == 9 ? 'selected' : '']">9</div>
                                </li>
                            </ul>
                        </li>
                        <li class="col-25 next">

                        </li>
                    </ul>
                </footer>
            </section>
        </section>
    </section>
</template>
<script>

    import swal from 'sweetalert2';
    import uppercase from "../../../../filters/string/uppercase";
    import capitalize from "../../../../filters/string/capitalize";
    import Preregistration from "../../../../models/Preregistration";
    import Bloodtype from "../../../../models/Bloodtype";
    import Medicalinsurance from "../../../../models/Medicalinsurance";
    import Prepaidmedical from "../../../../models/Prepaidmedical";
    import assets from "../../../../core/utils";

    export default {

        props: [
            'member',
            'preregistration',
        ],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize,
        },
        components: {},
        data: function () {
            return {
                bloodtypes: [],
                medicalinsurances: [],
                prepaidmedicals: [],
                assets: assets(),
                steps: 9,
                stepSelected: 0
            }
        },
        methods: {
            close() {
                this.$emit('close')
            },
            updateProfileMedical(event) {
                event.preventDefault();
                if (confirm(capitalize(this.$translate.text('sigeturbo.confirm_information')))) {
                    Preregistration.updateProfileMedical(this.preregistration.idpreregistration, {
                        bloodtype: this.preregistration.idbloodtype,
                        medicalinsurance: this.preregistration.idmedicalinsurance,
                        prepaidmedical: this.preregistration.idprepaidmedical,
                        policynumber: this.preregistration.policynumber,
                        medicaltreatment: this.preregistration.medicaltreatment,
                        medicaltreatmentdescription: this.preregistration.medicaltreatmentdescription,
                        equaltreatment: this.preregistration.equaltreatment,
                        takemedication: this.preregistration.takemedication,
                        medicationdescription: this.preregistration.medicationdescription,
                        whytakemedication: this.preregistration.whytakemedication,
                        dose: this.preregistration.dose,
                        isallergic: this.preregistration.isallergic,
                        specifyallergic: this.preregistration.specifyallergic,
                        sufferedillness: this.preregistration.sufferedillness,
                        sufferedillnessdescription: this.preregistration.sufferedillnessdescription,
                        doctorname: this.preregistration.doctorname,
                        doctorphone: this.preregistration.doctorphone,
                        psychologicalsupport: this.preregistration.psychologicalsupport,
                    }).then(({data}) => {
                        swal({
                            title: uppercase(this.$translate.text('sigeturbo.success')),
                            text: capitalize(this.$translate.text('sigeturbo.health_success')),
                            type: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result) {
                                this.preregistration.health_completed = 'Y';
                                this.$emit('close');
                            }
                        });
                    }).catch(error => console.log(error));
                }

            },
            setStep(step) {
                for (let i = 0; i <= this.steps; i++) {
                    document.getElementById('step-' + i).style.display = "none";
                }
                document.getElementById('step-' + step).style.display = "block";
                //Step Selected
                this.stepSelected = step;
            },
        },
        watch: {},
        created() {
            //Get All Bloodtypes
            Bloodtype.query('/api/v1/bloodtypes/', {})
                .then(({data}) => {
                    this.bloodtypes = data;
                }).catch(error => console.log(error));
            //Get All Medicalinsurances
            Medicalinsurance.query('/api/v1/medicalinsurances/', {})
                .then(({data}) => {
                    this.medicalinsurances = data;
                }).catch(error => console.log(error));
            //Get All Prepaidmedical
            Prepaidmedical.query('/api/v1/prepaidmedicals/', {})
                .then(({data}) => {
                    this.prepaidmedicals = data;
                }).catch(error => console.log(error));
        },
        mounted() {
        },
    }

</script>