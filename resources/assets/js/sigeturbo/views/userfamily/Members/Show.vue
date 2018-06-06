<template>
    <section class="sige-student-lists tooltip" title="Hello">
        <section class="student-list">
            <ul id="student-list">
                <template v-for="member in members">
                    <li>
                        <a :href="'parents/profile/'+ member.token + '/member'">
                            <div class="student" id="student" :data-student-id="member.iduser">
                                <div class="body" :id="'student_'+member.iduser">
                                    <div class="image normal-background">
                                        <img class="tooltip" :src="assets + '/img/users/' + member.photo"
                                             :alt="member.lastname"
                                             :title="member.lastname +' '+ member.firstname"/>
                                    </div>
                                </div>
                                <div class="lead">
                                    {{ member.firstname }}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </li>
                </template>
            </ul>
        </section>
    </section>
</template>
<script>

    import swal from 'sweetalert2';
    import assets from "../../../core/utils";
    import uppercase from "../../../filters/string/uppercase";
    import capitalize from "../../../filters/string/capitalize";

    export default {

        props: [
            'members',
        ],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize
        },
        components: {},
        data: function () {
            return {
                assets: assets()
            }
        },
        methods: {},
        watch: {},
        created() {
            swal({
                title: uppercase(this.$translate.text('sigeturbo.notice')),
                type: 'info',
                html: capitalize(this.$translate.text('sigeturbo.members_info'))
            })
        },
        mounted() {
        },
    }

</script>