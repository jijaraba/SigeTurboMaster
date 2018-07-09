<template>
    <section class="sige-items">
        <ul>
            <li v-for="enrollment in enrollments">
                <a v-bind:href="'/view/groupdirector/student/' + enrollment.iduser">
                    <figure class="medium">
                        <img :src=" assets + '/img/users/' + enrollment.photo"
                             :alt="enrollment.lastname"
                             :title="enrollment.lastname">
                        <figcaption>{{ enrollment.firstname }}</figcaption>
                    </figure>
                </a>
            </li>
        </ul>
    </section>
</template>

<script>

    import Enrollment from '../../models/Enrollment';
    import {assets} from "../../core/utils";

    export default {

        props: [
            'group',
        ],
        data: function () {
            return {
                enrollments: [],
                year: 2017,
                assets: assets()
            }
        },
        methods: {},
        mounted(){

        },
        created() {
            Enrollment.getEnrollments('/api/v1/enrollments/getenrollments', {
                year: this.year,
                group: this.group
            })
                .then(({data}) => this.enrollments = data)
                .catch(error => console.log(error));
        }

    }

</script>
