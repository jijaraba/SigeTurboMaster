<template>
    <section class="options">
        <template v-if="show">
            <ul class="display-horizontal col-90 option-container">
                <li>
                    <a href="#" @click="showProfile($event,'general')">
                        <template v-if="preregistration.general_completed === 'Y'">
                            <div class="tooltip" title="Completado">
                                <i class="fas fa-check-circle fa-3x"></i>
                            </div>
                        </template>
                        <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                        <span>{{ $translate.text('sigeturbo.general') | uppercase }}</span>
                    </a>
                </li>
                <template v-if="member.idcategory == category.idcategory">
                    <li>
                        <a href="#" @click="showProfile($event,'medical')">
                            <template v-if="preregistration.health_completed === 'Y'">
                                <div class="tooltip" title="Completado">
                                    <i class="fas fa-check-circle fa-3x"></i>
                                </div>
                            </template>
                            <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.medical') | uppercase }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click="showProfile($event,'additional')">
                            <template v-if="preregistration.additional_completed === 'Y'">
                                <div class="tooltip" title="Completado">
                                    <i class="fas fa-check-circle fa-3x"></i>
                                </div>
                            </template>
                            <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.additional') | uppercase }}</span>
                        </a>
                    </li>
                </template>
                <template v-if="member.idcategory !== category.idcategory">
                    <li>
                        <a href="#" @click="showProfile($event,'profession')">
                            <template v-if="preregistration.profession_completed === 'Y'">
                                <div class="tooltip" title="Completado">
                                    <i class="fas fa-check-circle fa-3x"></i>
                                </div>
                            </template>
                            <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.profession') | uppercase }}</span>
                        </a>
                    </li>
                </template>
                <template v-if="preregistrationEnable">
                    <template v-if="member.idcategory == category.idcategory">
                        <template
                                v-if="preregistration.general_completed === 'Y' && preregistration.health_completed === 'Y' && preregistration.additional_completed === 'Y'">
                            <li class="col-100 generate">
                                <input type="button" class="btn btn-aquamarine" value="Generar Pago"
                                       @click="generatePayment()">
                            </li>
                        </template>
                    </template>
                </template>
            </ul>
            <template v-if="profile.general">
                <sigeturbo-member-profile-general @close="close" :member="member"
                                                  :preregistration="preregistration"></sigeturbo-member-profile-general>
            </template>
            <template v-if="profile.medical">
                <sigeturbo-member-profile-medical @close="close" :member="member"
                                                  :preregistration="preregistration"></sigeturbo-member-profile-medical>
            </template>
            <template v-if="profile.additional">
                <sigeturbo-member-profile-additional @close="close" :member="member"
                                                     :preregistration="preregistration"></sigeturbo-member-profile-additional>
            </template>
            <template v-if="profile.profession">
                <sigeturbo-member-profile-profession @close="close" :member="member"
                                                     :preregistration="preregistration"></sigeturbo-member-profile-profession>
            </template>
        </template>
    </section>
</template>
<script>

    import swal from 'sweetalert2';
    import {assets} from "../../../core/utils";
    import Category from "../../../models/Category";
    import ProfileGeneral from './Profile/General';
    import ProfileMedical from './Profile/Medical';
    import ProfileAdditional from './Profile/Additional';
    import ProfileProfession from './Profile/Profession';
    import uppercase from "../../../filters/string/uppercase";
    import capitalize from "../../../filters/string/capitalize";
    import Payment from "../../../models/Payment";
    import Year from "../../../models/Year";

    export default {

        props: [
            'member',
            'preregistration',
        ],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize,
        },
        components: {
            'sigeturbo-member-profile-general': ProfileGeneral,
            'sigeturbo-member-profile-medical': ProfileMedical,
            'sigeturbo-member-profile-additional': ProfileAdditional,
            'sigeturbo-member-profile-profession': ProfileProfession,
        },
        data: function () {
            return {
                assets: assets(),
                category: [],
                show: false,
                profile: {
                    general: false,
                    medical: false,
                    additional: false,
                    profession: false,
                },
                preregistrationEnable: false
            }
        },
        methods: {
            showProfile(event, profile) {
                event.preventDefault();
                if (profile == 'general') {
                    this.profile.general = true;
                    this.profile.medical = false;
                    this.profile.additional = false;
                    this.profile.profession = false;
                } else if (profile == 'medical') {
                    this.profile.general = false;
                    this.profile.medical = true;
                    this.profile.additional = false;
                    this.profile.profession = false;
                } else if (profile == 'additional') {
                    this.profile.general = false;
                    this.profile.medical = false;
                    this.profile.additional = true;
                    this.profile.profession = false;
                } else if (profile == 'profession') {
                    this.profile.general = false;
                    this.profile.medical = false;
                    this.profile.additional = false;
                    this.profile.profession = true;
                }
            },
            close() {
                this.profile.general = false;
                this.profile.medical = false;
                this.profile.additional = false;
                this.profile.profession = false;

                if (this.preregistrationEnable) {
                    if (this.preregistration.general_completed == 'Y' && this.preregistration.health_completed == 'Y' && this.preregistration.additional_completed == 'Y') {
                        swal({
                            title: uppercase(this.$translate.text('sigeturbo.success')),
                            type: 'success',
                            html: capitalize(this.$translate.text('sigeturbo.payment_generate')),
                        })
                    }
                }
            },
            generatePayment() {
                if (this.preregistration.payment_created == 'N' && this.preregistration.payment_created !== undefined) {
                    Payment.generatePaymentByUser({
                        user: this.member.iduser
                    }).then(({data}) => {
                        if (data.successful) {
                            swal({
                                title: uppercase(this.$translate.text('sigeturbo.success')),
                                type: 'success',
                                html: capitalize(this.$translate.text('sigeturbo.payment_generated')),
                                footer: "<a href='/parents/payments'>Ir a la sección de Pagos Online</a>"
                            }).then((result) => {
                                if (result) {
                                    this.preregistration.payment_created = 'Y';
                                }
                            });
                        }
                    }).catch(error => console.log(error));
                } else {
                    swal({
                        title: uppercase(this.$translate.text('sigeturbo.warning')),
                        type: 'warning',
                        html: capitalize(this.$translate.text('sigeturbo.payment_warning_generated')),
                        footer: "<a href='/parents/payments'>Ir a la sección de Pagos Online</a>"
                    }).then((result) => {
                        if (result) {
                            this.preregistration.payment_created = 'Y';
                        }
                    });
                }
            }
        },
        watch: {},
        created() {

            if (this.preregistration.payment_created == undefined) {
                this.preregistration.payment_created = 'N';
            }

            //Get Current Preregistration
            Year.getCurrentPreregistration({}).then(({data}) => {
                if (data.idyear) {
                    this.preregistrationEnable = true;
                }
            }).catch(error => console.log(error));

            //Get Category Code By Name
            Category.getCategoryCodeByName({
                category: 'student'
            }).then(({data}) => {
                this.category = data;
                this.show = true;
            }).catch(error => console.log(error));
        },
        mounted() {
        },
    }

</script>