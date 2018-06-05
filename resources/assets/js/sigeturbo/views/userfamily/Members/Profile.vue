<template>
    <section class="options">
        <template v-if="show">
            <ul class="display-horizontal col-90 option-container">
                <li>
                    <a href="#" @click="showProfile($event,'general')">
                        <img :src='assets+ "/img/modules/profile_info_general1.svg"' alt=""/>
                        <span>{{ $translate.text('sigeturbo.general') | uppercase }}</span>
                    </a>
                </li>
                <template v-if="member.idcategory == category.idcategory">
                    <li>
                        <a href="#" @click="showProfile($event,'medical')">
                            <img :src='assets+ "/img/modules/profile_info_health.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.medical') | uppercase }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click="showProfile($event,'additional')">
                            <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.additional') | uppercase }}</span>
                        </a>
                    </li>
                </template>
                <template v-if="member.idcategory !== category.idcategory">
                    <li>
                        <a href="#" @click="showProfile($event,'profession')">
                            <img :src='assets+ "/img/modules/profile_info_profession.svg"' alt=""/>
                            <span>{{ $translate.text('sigeturbo.profession') | uppercase }}</span>
                        </a>
                    </li>
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

    import assets from "../../../core/utils";
    import Category from "../../../models/Category";
    import ProfileGeneral from './Profile/General';
    import ProfileMedical from './Profile/Medical';
    import ProfileAdditional from './Profile/Additional';
    import ProfileProfession from './Profile/Profession';
    import uppercase from "../../../filters/string/uppercase";

    export default {

        props: [
            'member',
            'preregistration',
        ],
        filters: {
            uppercase: uppercase,
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
                }
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
            }
        },
        watch: {},
        created() {
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