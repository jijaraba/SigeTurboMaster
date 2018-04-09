<template>
    <section class="methods">
        <ul class="display-horizontal col-70 method">
            <li>
                <a @click="showMethod(1)">
                    <img :src='assets+ "/img/modules/payment_massive.svg"' alt="Pago"/>
                    <span>PAGOS MASIVOS</span>
                </a>
            </li>
            <li>
                <a @click="showMethod(2)">
                    <img :src='assets + "/img/modules/payment_individual.svg"' alt="Pago"/>
                    <span>PAGOS INDIVIDUALES</span>
                </a>
            </li>
        </ul>
        <section v-if="showMassive" class="container-method massive">
            <form @submit="paymentSaveMassive()" id="payment_massive">
                <fieldset>
                    <legend>INFORMACIÓN AÑO DE COBRO</legend>
                    <ul class="display-horizontal col-100">
                        <li class="col-50 gutter-5">
                            <span>AÑO ACADÉMICO</span>
                            <select name="month" v-model="payment.academic">
                                <option value="2016">2016-2017</option>
                                <option value="2017" selected="selected">2017-2018</option>
                                <option value="2018">2018-2019</option>
                            </select>
                        </li>
                        <li class="col-50 gutter-5">
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <legend>INFORMACIÓN DEL PAGO</legend>
                    <ul class="display-horizontal col-100">
                        <li class="col-20">
                            <span>AÑO</span>
                            <input type="text" value="" v-model="payment.year">
                        </li>
                        <li class="col-20">
                            <span>MES</span>
                            <select name="month" v-model="payment.month">
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </li>
                        <li class="col-20">
                            <span>DESCUENTO</span>
                            <input type="text" v-model="payment.date1" value="" placeholder="Fecha Descuento">
                        </li>
                        <li class="col-20">
                            <span>NORMAL</span>
                            <input type="text" v-model="payment.date2" value="" placeholder="Fecha Normal">
                        </li>
                        <li class="col-20">
                            <span>INTERÉS</span>
                            <input type="text" v-model="payment.date3" value="" placeholder="Fecha Intereres">
                        </li>
                        <li class="col-30">
                            <select name="month" v-model="payment.type" required>
                                <option :value="concepttype.type" v-for="concepttype in concepttypes">{{ concepttype.name }}</option>
                            </select>
                        </li>
                        <li class="col-70">
                            <input type="text" v-model="payment.concept" value="" placeholder="Concepto de Pago"
                                   style="text-align: left">
                        </li>
                        <li class="col-100 border">
                        <textarea v-model="payment.exclude"
                                  placeholder="Especificar estudiantes a excluir separados por coma ',' y sin espacios."></textarea>
                        </li>
                    </ul>
                    <section class="info_generic">
                        <div>
                            <i class="icon icon-info col-10" href="#"></i>
                            <span class="col-90">La <strong>generación masiva</strong> asigna los pagos para los estudiantes matriculados al momento de su ejecución. Para estudiantes <strong>Matriculados</strong> después de la fecha de generación deben ser ingresados individualmente.</span>
                        </div>
                    </section>
                    <button value="Save" class="btn btn-aquamarine" type="submit">Generar</button>
                </fieldset>
            </form>
        </section>
        <section v-if="showIndividual" class="container-method individual">
            <form @submit="paymentSaveIndividual()" id="payment_individual">
                <fieldset>
                    <legend>INFORMACIÓN DEL ESTUDIANTE</legend>
                    <ul class="display-horizontal col-100">
                        <li class="col-50 gutter-5">
                            <span>AÑO ACADÉMICO</span>
                            <select name="month" v-model="payment.academic">
                                <option value="2016">2016-2017</option>
                                <option value="2017">2017-2018</option>
                                <option value="2018" selected="selected">2018-2019</option>
                            </select>
                        </li>
                        <li class="col-50 gutter-5">
                            <span>CÓDIGO</span>
                            <input type="text" value="" v-model="payment.student" placeholder="Código"
                                   @blur="searchStudent()">
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <legend>INFORMACIÓN DEL PAGO</legend>
                    <ul class="display-horizontal col-100">
                        <li class="col-20">
                            <span>AÑO</span>
                            <input type="text" value="" v-model="payment.year">
                        </li>
                        <li class="col-20">
                            <span>MES</span>
                            <select name="month" v-model="payment.month">
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </li>
                        <li class="col-20">
                            <span>DESCUENTO</span>
                            <input type="text" v-model="payment.date1" value="" placeholder="Fecha Descuento">
                        </li>
                        <li class="col-20">
                            <span>NORMAL</span>
                            <input type="text" v-model="payment.date2" value="" placeholder="Fecha Normal">
                        </li>
                        <li class="col-20">
                            <span>INTERÉS</span>
                            <input type="text" v-model="payment.date3" value="" placeholder="Fecha Intereres">
                        </li>
                        <li class="col-30">
                            <select name="month" v-model="payment.type" required>
                                <option :value="concepttype.type" v-for="concepttype in concepttypes">{{ concepttype.name }}</option>
                            </select>
                        </li>
                        <li class="col-70">
                            <input type="text" v-model="payment.concept" value="" placeholder="Concepto de Pago"
                                   style="text-align: left">
                        </li>
                        <li class="col-33">
                            <input type="text" v-model="payment.value1" value="" placeholder="Valor Descuento">
                        </li>
                        <li class="col-33">
                            <input type="text" v-model="payment.value2" value="" placeholder="Valor Normal">
                        </li>
                        <li class="col-33">
                            <input type="text" v-model="payment.value3" value="" placeholder="Valor Intereres">
                        </li>
                        <li class="col-100 border">
                            <textarea v-model="payment.result"></textarea>
                        </li>
                    </ul>
                    <section class="info_generic">
                        <div>
                            <i class="icon icon-info col-10" href="#"></i>
                            <span class="col-90">La <strong>generación individual</strong> asigna un pago al estudiante seleccionado. El SigeTurbo identifica el grado del estudiante y asigna los valores respectivos</span>
                        </div>
                    </section>
                    <button type="submit" value="Submit" class="btn btn-aquamarine">
                        Generar
                    </button>
                </fieldset>
            </form>
        </section>
    </section>

</template>
<script>

    import assets from '../../../core/utils';

    export default {

        props: [],
        filters: {},
        components: {},
        data: function () {
            return {
                assets: assets()
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