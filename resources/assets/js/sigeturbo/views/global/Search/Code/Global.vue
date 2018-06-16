<template>
    <section class="sige-search-list col-50">
        <form @submit="searchUsers($event)">
            <ul class="display-horizontal col-100">
                <li class="col-100 icon-right">
                    <button type="submit">
                        <i class="fas fa-search fa-lg"></i>
                    </button>
                    <input type="text" v-model="search">
                </li>
            </ul>
        </form>
    </section>
</template>
<script>

    import Family from "../../../../models/Family";

    export default {

        props: [],
        filters: {},
        components: {},
        data: function () {
            return {
                search: ''
            }
        },
        methods: {
            searchUsers(event) {
                event.preventDefault();
                //Search By Family
                Family.searchFamilyByName({
                    search: this.search
                }).then(({data}) => {
                    if (data.idfamily) {
                        this.$emit('result', {successful: true, category: 1, search: data.idfamily})
                    } else {
                        this.$emit('result', {successful: false})
                    }
                }).catch(error => console.log(error));
            }
        },
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>