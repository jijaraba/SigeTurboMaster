<template>
    <section class="sige-costs-container">
        <section class="header">
            <form>
                <fieldset>
                    <ul class="display-horizontal col-100">
                        <li class="col-30 gutter-5">
                            <span>{{ $translate.text('sigeturbo.year') | uppercase }}</span>
                            <select id="year" name="year" v-model="cost.year"
                                    required>
                                <option :value="year.idyear" v-for="year in years">{{
                                    year.name }}
                                </option>
                            </select>
                        </li>
                        <li class="col-30 gutter-5">
                            <span>{{ $translate.text('sigeturbo.grade') | uppercase }}</span>
                            <select id="grade" name="grade" v-model="cost.grade"
                                    required>
                                <option :value="grade.idgrade" v-for="grade in grades">{{
                                    grade.name }}
                                </option>
                            </select>
                        </li>
                        <li class="col-40 gutter-5">
                            <span>{{ $translate.text('sigeturbo.concept_type') | uppercase }}</span>
                            <select id="concepttype" name="concepttype" v-model="cost.concepttype"
                                    required>
                                <option :value="concepttype.idconcepttype" v-for="concepttype in concepttypes">{{
                                    concepttype.name }}
                                </option>
                            </select>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </section>
    </section>
</template>
<script>

    import capitalize from "../../../../filters/string/capitalize";
    import uppercase from "../../../../filters/string/uppercase";

    export default {

        props: [
            'years',
            'year',
            'grades',
            'concepttypes',
        ],
        filters: {
            capitalize: capitalize,
            uppercase: uppercase,
        },
        components: {},
        data: function () {
            return {
                cost: {
                    year: this.year,
                    grade: 1,
                    concepttype: 2,
                }
            }
        },
        methods: {},
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>