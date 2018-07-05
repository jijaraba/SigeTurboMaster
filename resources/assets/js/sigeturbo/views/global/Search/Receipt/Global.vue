<template>
    <section class="sige-search-list col-50">
        <form @submit="searchReceipts($event)">
            <ul class="display-horizontal col-100">
                <li class="col-100 icon-right">
                    <input type="text" v-model="document"
                           :placeholder="$translate.text('sigeturbo.receipt_document_help') | capitalize">
                    <select v-model="voucher">
                        <option value=1>{{ $translate.text('sigeturbo.receipt_virtual') | uppercase }}</option>
                        <option value=2>{{ $translate.text('sigeturbo.receipt_manual') | uppercase }}</option>
                        <option value=3>{{ $translate.text('sigeturbo.receipt_invoice') | uppercase }}</option>
                        <option value=4>{{ $translate.text('sigeturbo.receipt_advance') | uppercase }}</option>
                    </select>
                    <button type="submit">
                        <i class="fas fa-search fa-lg"></i>
                    </button>
                </li>
            </ul>
        </form>
    </section>
</template>
<script>

    import Family from "../../../../models/Family";
    import uppercase from "../../../../filters/string/uppercase";
    import assets from "../../../../core/utils";
    import capitalize from "../../../../filters/string/capitalize";

    export default {

        props: [],
        filters: {
            uppercase: uppercase,
            capitalize: capitalize,
        },
        components: {},
        data: function () {
            return {
                voucher: 2,
                document: '',
                results: [],
                assets: assets(),
            }
        },
        methods: {
            searchReceipts(event) {
                event.preventDefault();
                this.$emit('result', {successful: true, voucher: this.voucher, document: this.document})
            }
        },
        watch: {},
        created() {
        },
        mounted() {
        },
    }

</script>