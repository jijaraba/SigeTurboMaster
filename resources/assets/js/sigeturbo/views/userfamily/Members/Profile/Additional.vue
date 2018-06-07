<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 800px;">
            <div class="close" @click="close()">
                <i class="fas fa-window-close fa-lg"></i>
            </div>
            <section class="sige-wizard-container padding-30">
                <header>
                    <h4>{{ $translate.text('sigeturbo.additional') | uppercase }}</h4>
                </header>
                <section class="body">
                    <form @submit="updateProfileAdditional($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/profile_info_additional_welcome.svg"' alt=""/>
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
                                    <h4>{{ $translate.text('sigeturbo.educational_output') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar si autoriza la realización de <strong>Salidas Pedagógicas</strong> del estudiante durante el año académico
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.educational_output') | uppercase }}</span>
                                    <select name="educationaloutput"
                                            v-model="preregistration.educationaloutput" required>
                                        <option value="Y">{{ $translate.text('sigeturbo.yes') | capitalize }}</option>
                                        <option value="N">{{ $translate.text('sigeturbo.no') | capitalize }}</option>
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
                                    <h4>{{ $translate.text('sigeturbo.responsible') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar el nombre completo del responsable económico del estudiante. En caso de ser una empresa por favor especificar el nombre y el NIT.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.responsible') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.responsible"
                                           :placeholder="$translate.text('sigeturbo.responsible') | uppercase" required/>
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
                                    <h4>{{ $translate.text('sigeturbo.observation_additional') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Tiene algún comentario que adicionar a esta actualización de datos que considera que la institución deba tener en cuenta.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.observation_additional') | uppercase }}</span>
                                    <textarea rows="2" name="observation"
                                              v-model="preregistration.observation"
                                              :placeholder="$translate.text('sigeturbo.observation_additional') | uppercase"></textarea>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(4)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-4" data-step="4">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 6</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <h4>{{ $translate.text('sigeturbo.save') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Confirmar la actualización de la información en nuestro sistema de informacuón (SigeTurbo). Si la información está completa por favor proceder a dar clic en el botón guardar
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
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

    import swal from 'sweetalert2';
    import uppercase from "../../../../filters/string/uppercase";
    import capitalize from "../../../../filters/string/capitalize";
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
                steps: 4,
                stepSelected: 0
            }
        },
        methods: {
            close() {
                this.$emit('close')
            },
            updateProfileAdditional(event) {
                event.preventDefault();
                if (confirm(capitalize(this.$translate.text('sigeturbo.confirm_information')))) {
                    Preregistration.updateProfileAdditional(this.preregistration.idpreregistration, {
                        educationaloutput: this.preregistration.educationaloutput,
                        responsible: this.preregistration.responsible,
                        observation: this.preregistration.observation,
                    }).then(({data}) => {
                        swal({
                            title: uppercase(this.$translate.text('sigeturbo.success')),
                            text: capitalize(this.$translate.text('sigeturbo.additional_success')),
                            type: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            if (result) {
                                this.preregistration.additional_completed = 'Y';
                                this.$emit('close')
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
        },
        mounted() {
        },
    }

</script>