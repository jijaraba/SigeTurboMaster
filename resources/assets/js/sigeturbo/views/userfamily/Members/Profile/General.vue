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
                    <form @submit="updateProfileGeneral($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/profile_info_general_welcome1.svg"' alt=""/>
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
                                    <h4>{{ $translate.text('sigeturbo.fullname') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Verificar los <strong>Nombres y Apellidos</strong>. En caso de existir algún error en la redacción por favor corregirlos. El <strong>Código</strong> asignado por el usuario solo puede ser modificado en el Área de Admisiones.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.code') | uppercase }}</span>
                                    <input type="text" v-model="preregistration.iduser"
                                           :placeholder="$translate.text('sigeturbo.code_title') | capitalize" required
                                           readonly>
                                </li>
                                <li class="col-40 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.lastname') | uppercase }}</span>
                                    <input type="text" v-model="preregistration.lastname"
                                           :placeholder="$translate.text('sigeturbo.lastname') | capitalize" required>
                                </li>
                                <li class="col-40 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.firstname') | uppercase }}</span>
                                    <input type="text" v-model="preregistration.firstname"
                                           :placeholder="$translate.text('sigeturbo.firstname') | capitalize" required>
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
                                    <h4>{{ $translate.text('sigeturbo.identification') | uppercase }}</h4>
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
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.identification_type') | uppercase }}</span>
                                    <select vg-model="preregistration.ididentificationtype">
                                        <option :value="identificationtype.ididentificationtype"
                                                v-for="identificationtype in identificationtypes">{{
                                            identificationtype.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.identification') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.identification"
                                           :placeholder="$translate.text('sigeturbo.identification') | uppercase"
                                           required/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.expedition') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.expedition"
                                           :placeholder="$translate.text('sigeturbo.expedition') | uppercase"
                                           required/>
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
                                    <h4>{{ $translate.text('sigeturbo.religion') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar la <strong>Religión</strong> para el usuario que se está actualizando. En caso de no practicar seleccionar la opción <strong>Ninguna</strong>
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.religion') | uppercase }}</span>
                                    <select v-model="preregistration.idreligion">
                                        <option :value="religion.idreligion"
                                                v-for="religion in religions">{{
                                            religion.name }}
                                        </option>
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
                                    <h4>{{ $translate.text('sigeturbo.address') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Inidar la <strong>Dirección, Barrio y Municipio</strong> de la vivienda del usuario para el cual se está actualizando la información
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-50 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.address') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.address"
                                           :placeholder="$translate.text('sigeturbo.address') | uppercase" required/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.district') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.district"
                                           :placeholder="$translate.text('sigeturbo.district') | uppercase" required/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.town') | uppercase }}</span>
                                    <input type="text" v-model="preregistration.town"
                                           :placeholder="$translate.text('sigeturbo.town') | uppercase" required/>
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
                                    <h4>{{ $translate.text('sigeturbo.email') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar la <strong>Email, el Teléfono Fijo y Celular</strong> del usuario para el cual se está actualizando la información
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-50 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.email') | uppercase }}</span>
                                    <input type="email" v-model="preregistration.email"
                                           :placeholder="$translate.text('sigeturbo.email') | uppercase" required/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.phone') | uppercase }}</span>
                                    <input type="text" v-model="preregistration.phone"
                                           :placeholder="$translate.text('sigeturbo.phone') | uppercase"/>
                                </li>
                                <li class="col-25 gutter-5" id="celular_container">
                                    <span>{{ $translate.text('sigeturbo.celular') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.celular"
                                           :placeholder="$translate.text('sigeturbo.celular') | uppercase" required/>
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
                                    <h4>{{ $translate.text('sigeturbo.save') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Guardar la información procesada del usuario para el usuario para el cual se está ingresando la información en SigeTurbo
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <input class="btn btn-aquamarine" type="submit"
                                           :value="$translate.text('sigeturbo.save') | capitalize">

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
                                <li @click="setStep(5)">
                                    <div :class="[stepSelected == 5 ? 'selected' : '']">5</div>
                                </li>
                                <li @click="setStep(6)">
                                    <div :class="[stepSelected == 6 ? 'selected' : '']">6</div>
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

    import uppercase from "../../../../filters/string/uppercase";
    import capitalize from "../../../../filters/string/capitalize";
    import Identificationtype from "../../../../models/Identificationtype";
    import Religion from "../../../../models/Religion";
    import Preregistration from "../../../../models/Preregistration";
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
                assets: assets(),
                identificationtypes: [],
                religions: [],
                steps: 6,
                stepSelected: 0
            }
        },
        methods: {
            capitalize: capitalize,
            close() {
                this.$emit('close')
            },
            updateProfileGeneral(event) {
                event.preventDefault();
                if (confirm(capitalize(this.$translate.text('sigeturbo.confirm_information')))) {
                    Preregistration.updateProfileGeneral(this.preregistration.idpreregistration, {
                        user: this.preregistration.iduser,
                        lastname: this.preregistration.lastname,
                        firstname: this.preregistration.firstname,
                        identificationtype: this.preregistration.ididentificationtype,
                        identification: this.preregistration.identification,
                        expedition: this.preregistration.expedition,
                        religion: this.preregistration.idreligion,
                        address: this.preregistration.address,
                        district: this.preregistration.district,
                        town: this.preregistration.town,
                        email: this.preregistration.email,
                        phone: this.preregistration.phone,
                        celular: this.preregistration.celular,
                    }).then(({data}) => {
                        this.$emit('close')
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
            //Get All Identificationtypes
            Identificationtype.query('/api/v1/identificationtypes', {})
                .then(({data}) => {
                    this.identificationtypes = data;
                }).catch(error => console.log(error));
            //Get All Identificationtypes
            Religion.query('/api/v1/religions', {})
                .then(({data}) => {
                    this.religions = data;
                }).catch(error => console.log(error));

        },
        mounted() {
        },
    }

</script>