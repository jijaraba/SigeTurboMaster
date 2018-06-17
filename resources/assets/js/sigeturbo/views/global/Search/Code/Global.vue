<template>
    <section class="sige-search-list col-50">
        <form @submit="searchUsers($event)">
            <ul class="display-horizontal col-100">
                <li class="col-100 icon-right">
                    <input type="text" @keyup="showSearchForm()" v-model="search" debounce="2000">
                    <select v-model="category">
                        <option value=1>{{ $translate.text('sigeturbo.family') | uppercase }}</option>
                        <option value=2>{{ $translate.text('sigeturbo.student') | uppercase }}</option>
                        <option value=3>{{ $translate.text('sigeturbo.responsible_singular') | uppercase }}</option>
                    </select>
                    <button type="button">
                        <i class="fas fa-search fa-lg"></i>
                    </button>
                </li>
            </ul>
        </form>
        <section class="sige-search-result padding-10" v-show="showSearchResult" v-if="results.length > 0">
            <div class="close" @click="closeSearchForm()">
                <i class="fas fa-times" aria-hidden="true"></i>
            </div>
            <section class="result">
                <ul class="display-horizontal col-100">
                    <li class="col-100">
                        <ul class="display-horizontal col-100 users" v-for="(result,index) in results">
                            <li class="col-20 code">
                                <div @click="selectFamily(result.idfamily)">{{ result.idfamily }}</div>
                            </li>
                            <li class="col-30 name">
                                <div>{{ result.name }}</div>
                            </li>
                            <li class="col-50 photo">
                                <div class="photo-container">
                                    <template v-for="user in result.users">
                                        <div>
                                            <img :src="assets + '/img/users/' + user.photo"
                                                 :alt="user.lastname +' '+user.firstname"
                                                 :title="user.lastname +' '+user.firstname">
                                        </div>
                                    </template>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </section>
        </section>
    </section>
</template>
<script>

    import Family from "../../../../models/Family";
    import uppercase from "../../../../filters/string/uppercase";
    import assets from "../../../../core/utils";

    export default {

        props: [],
        filters: {
            uppercase: uppercase,
        },
        components: {},
        data: function () {
            return {
                showSearchResult: false,
                search: '',
                category: 1,
                results: [],
                assets: assets(),
            }
        },
        methods: {
            showSearchForm() {
                if (this.search.length > 2) {
                    this.showSearchResult = true;
                }
            },
            closeSearchForm() {
                this.showSearchResult = false;
            },
            searchUsers(event) {
                event.preventDefault();
                //Search By Family
                Family.searchFamilyByName({
                    search: this.search
                }).then(({data}) => {
                    if (data.idfamily) {

                    } else {
                        this.$emit('result', {successful: false})
                    }
                }).catch(error => console.log(error));
            },
            selectFamily(result) {
                this.$emit('result', {successful: true, category: this.category, search: result})
            }
        },
        watch: {
            'search': function (newSearch, oldSearch) {
                if (newSearch != oldSearch) {
                    if (newSearch.length > 3) {
                        if (typeof newSearch != 'undefined') {
                            if (this.category == 1) {
                                Family.searchFamilyByName({
                                    search: this.search
                                }).then(({data}) => {
                                    this.results = data;
                                }).catch(error => console.log(error));
                            }
                        } else {
                            this.users = [];
                        }
                    } else {
                        this.users = [];
                    }
                }
            },
        },
        created() {
        },
        mounted() {
        },
    }

</script>