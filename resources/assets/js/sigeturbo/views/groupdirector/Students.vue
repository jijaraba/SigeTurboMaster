<template>
    <section>
        <ul>
            <li v-for="enrollment in enrollments">
                <a v-bind:href="'/view/groupdirector/student/' + enrollment.iduser">{{ enrollment.firstname }}</a>
            </li>
        </ul>
    </section>
</template>

<script>

    import Enrollments from '../../models/Enrollments';

    export default {

        data: function () {
            return {
                enrollments: [],
                year: 2017,
                group: 31
            }
        },
        methods: {},
        created() {
            Enrollments.getEnrollments('/api/v1/enrollments/getenrollments', {
                year: this.year,
                group: this.group
            })
                .then(({data}) => this.enrollments = data)
                .catch(error => console.log(error));
        }

    }

</script>
