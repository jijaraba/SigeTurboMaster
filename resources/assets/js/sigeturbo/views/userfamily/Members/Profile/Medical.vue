<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 750px;">
            <div class="close" @click="close()">
                <i class="fas fa-window-close fa-lg"></i>
            </div>
            <section class="sige-wizard-container padding-30">
                <form @submit="updateProfileMedical($event)">
                    <fieldset class="step" id="step-01" data-step="1">
                        <legend>{{ $translate.text('sigeturbo.medical') | uppercase }}</legend>
                        <ul class="display-horizontal col-100">
                            <li class="col-25 gutter-5">
                                <span>{{ $translate.text('sigeturbo.blood_type') | uppercase }}</span>
                                <select v-model="preregistration.idbloodtype">
                                    <option :value="bloodtype.idbloodtype" v-for="bloodtype in bloodtypes">{{
                                        bloodtype.name }}
                                    </option>
                                </select>
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
                            <li class="col-30 gutter-5">
                                <span>{{ $translate.text('sigeturbo.medical_treatment') | uppercase }}</span>
                                <select name="medicaltreatment" v-model="preregistration.medicaltreatment">
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
                                        v-model="preregistration.equaltreatment">
                                    <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                    <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                </select>

                            </li>
                            <li class="col-30 gutter-5">
                                <span>{{ $translate.text('sigeturbo.take_medication') | uppercase }}</span>
                                <select name="takemedication"
                                        v-model="preregistration.takemedication">
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
                            <li class="col-20 gutter-5" id="isallergic_container">
                                <span>{{ $translate.text('sigeturbo.is_allergic') | uppercase }}</span>
                                <select name="isallergic" v-model="preregistration.isallergic">
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
                            <li class="col-40 gutter-5">
                                <span>{{ $translate.text('sigeturbo.suffered_illness') | uppercase }}</span>
                                <select name="sufferedillness"
                                        v-model="preregistration.sufferedillness">
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
                            <li class="col-100 gutter-5">
                                <span>{{ $translate.text('sigeturbo.psychological_support') | uppercase }}</span>
                                <select name="psychologicalsupport"
                                        v-model="preregistration.psychologicalsupport">
                                    <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
                                    <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                </select>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100">
                                <input class="btn btn-aquamarine" type="submit"
                                       :value="$translate.text('sigeturbo.save') | capitalize">
                            </li>
                        </ul>
                    </fieldset>
                </form>
            </section>
        </section>
    </section>
</template>
<script>

    import uppercase from "../../../../filters/string/uppercase";
    import capitalize from "../../../../filters/string/capitalize";
    import Preregistration from "../../../../models/Preregistration";
    import Bloodtype from "../../../../models/Bloodtype";
    import Medicalinsurance from "../../../../models/Medicalinsurance";
    import Prepaidmedical from "../../../../models/Prepaidmedical";

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
            }
        },
        methods: {
            close() {
                this.$emit('close')
            },
            updateProfileMedical(event) {
                event.preventDefault();
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
                    this.$emit('close')
                }).catch(error => console.log(error));

            }
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