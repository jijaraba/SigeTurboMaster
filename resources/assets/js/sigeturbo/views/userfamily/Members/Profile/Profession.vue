<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 750px;">
            <div class="close" @click="close()">
                <i class="fas fa-window-close fa-lg"></i>
            </div>
            <section class="sige-wizard-container padding-30">
                <header>
                    <h4>{{ $translate.text('sigeturbo.general') | uppercase }}</h4>
                </header>
                <section class="body">
                    <form @submit="updateProfileProfession($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/profile_info_profession_welcome.svg"' alt=""/>
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
                                    <h4>{{ $translate.text('sigeturbo.profession') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar la <strong>Profesión</strong> del padre de familia para el cual se está actualizando la información en SigeTurbo
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.profession') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.profession"
                                           :placeholder="$translate.text('sigeturbo.profession') | uppercase"/>
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
                                    <h4>{{ $translate.text('sigeturbo.occupation') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar la <strong>Ocupación</strong> del padre de familia para el cual se está actualizando la información en SigeTurbo
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.occupation') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.occupation"
                                           :placeholder="$translate.text('sigeturbo.occupation') | uppercase"/>
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
                                    <h4>{{ $translate.text('sigeturbo.company') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Especificar la información de la empresa para la cual trabajo el padre de familia (Opcional). Indicar nombre de la empresa y teléfono
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 gutter-5 icon">
                                    <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
                                </li>
                                <li class="col-70 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.company') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.company"
                                           :placeholder="$translate.text('sigeturbo.company_title') | uppercase"/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.company_phone') | uppercase }}</span>
                                    <input type="text"
                                           v-model="preregistration.phone"
                                           :placeholder="$translate.text('sigeturbo.company_phone') | uppercase"/>
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
                                    <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
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
            updateProfileProfession(event) {
                event.preventDefault();
                if (confirm(capitalize(this.$translate.text('sigeturbo.confirm_information')))) {
                    Preregistration.updateProfileProfession(this.preregistration.idpreregistration, {
                        profession: this.preregistration.profession,
                        occupation: this.preregistration.occupation,
                        company: this.preregistration.company,
                        phone: this.preregistration.phone,
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
        },
        mounted() {
        },
    }

</script>