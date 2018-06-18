<template>
    <section class="sige-main-modal" style="display: block;padding-top: 100px">
        <section class="modal-content" style="width: 850px;height: 700px">
            <div class="close" @click="closeReceipt()">
                <span class="fa fa-times" aria-hidden="true"></span>
            </div>
            <section class="sige-wizard-container padding-30">
                <header>
                    <h4>{{ $translate.text('sigeturbo.receipt') | uppercase }}</h4>
                </header>
                <section class="body">
                    <form @submit="updateProfileAdditional($event)">
                        <fieldset class="welcome" id="step-0" data-step="0">
                            <legend>Welcome</legend>
                            <ul class="display-horizontal col-100">
                                <li>
                                    <img :src='assets+ "/img/modules/profile_info_additional_welcome.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(1)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.start') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-1" data-step="1">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 1</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <h4>{{ $translate.text('sigeturbo.charge_list') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Seleccione los cobros sobre los cuales desea realizar el <strong>Recibo</strong>. Retire del listado los pagos que no harán parte del recibo e igualmente cambie el valor para los pagos parciales.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <section class="sige-financials-transactions">
                                        <section class="payments">
                                            <section class="payment-calendar-horizontal">
                                                <template v-for="payment in payments">
                                                    <sigeturbo-financials-payment-detail :payments="payments"
                                                                                         :payment="payment"
                                                                                         @removePayment="removePayment"
                                                                                         @calculateTotal="calculateTotal"></sigeturbo-financials-payment-detail>
                                                </template>
                                                <section>
                                                    <ul class="display-horizontal col-100">
                                                        <li class="col-05 check">
                                                            <div>

                                                            </div>
                                                        </li>
                                                        <li class="col-05 icon">
                                                            <div>

                                                            </div>
                                                        </li>
                                                        <li class="col-10 type">
                                                            <div>

                                                            </div>
                                                        </li>

                                                        <li class="col-35 concept">
                                                            <div>

                                                            </div>
                                                        </li>
                                                        <li class="col-15 value">
                                                            <div>

                                                            </div>
                                                        </li>
                                                        <li class="col-15 value">
                                                            <div>
                                                                {{ payments | chargeTotalRealValue | currency }}
                                                            </div>
                                                        </li>
                                                        <li class="col-05 delete">

                                                        </li>
                                                    </ul>
                                                </section>
                                            </section>
                                        </section>
                                    </section>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(2)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">

                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-2" data-step="2">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 2</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <h4>{{ $translate.text('sigeturbo.receipt_form') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Diligenciar los cambios que hacen parte del <strong>Recibo</strong>. Al momento de seleccionar el <strong>Tipo de Comprobante</strong> el listado trae el consecutivo vigente.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.bank') | uppercase }}</span>
                                    <select id="bank" class="bank" name="bank" v-model="receipt.bank" required>
                                        <option :value="bank.idbank" v-for="bank in banks">{{ bank.name }} ({{
                                            bank.accounttype_code }})
                                        </option>
                                    </select>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.voucher') | uppercase }}</span>
                                    <select id="voucher" class="voucher" name="voucher" v-model="receipt.voucher"
                                            required>
                                        <option :value="vouchertype.idvouchertype" v-for="vouchertype in vouchertypes">
                                            {{ vouchertype.name }}
                                        </option>
                                    </select>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.consecutive') | uppercase }}</span>
                                    <input type="text" v-model="receipt.consecutive"
                                           placeholder="$translate.text('sigeturbo.consecutive') | capitalize" required>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.value') | uppercase }}</span>
                                    <input type="text" v-model="receipt.value"
                                           :placeholder="$translate.text('sigeturbo.value') | capitalize" required>
                                </li>
                                <li class="col-20 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.date') | uppercase }}</span>
                                    <input type="text" v-model="receipt.date"
                                           :placeholder="$translate.text('sigeturbo.date') | capitalize" required>
                                </li>
                                <li class="col-100 gutter-5">
                                    <span>{{ $translate.text('sigeturbo.description') | uppercase }}</span>
                                    <textarea class="description" name="description" id="description" rows="2"
                                              v-model="receipt.description"
                                              :placeholder="$translate.text('sigeturbo.description') | uppercase"
                                              required></textarea>
                                </li>
                                <li class="col-100">
                                    <template v-if="saveReceiptEnable">
                                        <input @click="saveReceipt()" class="btn btn-aquamarine" type="button"
                                               :value="$translate.text('sigeturbo.save') | capitalize">
                                    </template>
                                    <template v-if="!saveReceiptEnable">
                                        <input @click="setStep(3)" class="btn btn-aquamarine" type="button"
                                               :value="$translate.text('sigeturbo.next') | capitalize">
                                    </template>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-3" data-step="3">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 3</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <h4>{{ $translate.text('sigeturbo.accountingentries') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Revisar las <strong>Asientos Contables</strong> generados automáticamente por el sistema, en caso de existir inconsistencias por favor realizar los respectivos cambios.
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100">
                                    <section class="sige-financials-transactions">
                                        <section class="payments">
                                            <section class="transactions">
                                                <template v-if="receipt.idreceipt > 0">
                                                    <sigeturbo-financials-accountingentries-show load="load"
                                                                                                 :receipt="receipt"
                                                                                                 @calculateTotal=""></sigeturbo-financials-accountingentries-show>
                                                </template>
                                            </section>
                                        </section>
                                    </section>
                                </li>
                                <li class="col-100">
                                    <input @click="setStep(4)" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.next') | capitalize">

                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="step" id="step-4" data-step="4">
                            <legend>{{ $translate.text('sigeturbo.step') | uppercase }} 4</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <h4>{{ $translate.text('sigeturbo.generate_receipt') | uppercase }}</h4>
                                    <section class="info_generic aquamarine">
                                        <div>
                                            <i class="fas fa-info-circle fa-2x" style="color:white"></i>
                                            <span class="col-90">
                                                Listo. Ya se se puede generar el <strong>Recibo</strong> correspondiente al pago realizado por el <strong>Padre de Familia</strong>. El recibo es generado en formato PDF
                                            </span>
                                        </div>
                                    </section>
                                </li>
                                <li class="col-100 icon">
                                    <img :src='assets+ "/img/modules/profile_info_additional.svg"' alt=""/>
                                </li>
                                <li class="col-100">
                                    <div style="margin: 10px auto;color:#53BBB4;text-align:center">
                                        <i class="fas fa-receipt fa-5x"></i>
                                    </div>
                                    <input @click="generateReceipt()" class="btn btn-aquamarine" type="button"
                                           :value="$translate.text('sigeturbo.generate') | capitalize">
                                </li>
                            </ul>
                        </fieldset>
                    </form>
                </section>
                <footer>
                    <ul class="display-horizontal col-100">
                        <li class="col-35 previous"></li>
                        <li class="col-30 steps">
                            <ul class="display-horizontal col-100">
                                <li @click="setStep(1)">
                                    <div :class="[stepSelected == 1 ? 'selected' : '']">1</div>
                                </li>
                                <li @click="setStep(2)">
                                    <div :class="[stepSelected == 2 ? 'selected' : '']">2</div>
                                </li>
                                <li @click="setStep(3)">
                                    <div :class="[stepSelected == 3 ? 'selected' : '']">3</div>
                                </li>
                                <li @click="setStep(4)">
                                    <div :class="[stepSelected == 4 ? 'selected' : '']">4</div>
                                </li>
                            </ul>
                        </li>
                        <li class="col-35 next">

                        </li>
                    </ul>
                </footer>
            </section>
        </section>
    </section>
</template>
<script>

    import swal from 'sweetalert2';
    import uppercase from "../../../../filters/string/uppercase";
    import currency from "../../../../filters/other/currency";
    import assets from "../../../../core/utils";
    import paymentType from "../../../../filters/payment/paymentType";
    import {chargeSubtotal, chargeTotalRealValue} from "../../../../filters/payment/charge";
    import capitalize from "../../../../filters/string/capitalize";
    import FinancialAccountingentryShow from '../Accountingentry/Show';
    import FinancialPaymentDetail from './Detail';
    import Vouchertype from "../../../../models/Vouchertype";
    import titlecase from "../../../../filters/string/titlecase";
    import Receipt from "../../../../models/Receipt";

    export default {

        props: [
            'banks',
            'payments',
            'showReceipt'
        ],
        filters: {
            uppercase: uppercase,
            titlecase: titlecase,
            capitalize: capitalize,
            paymentType: paymentType,
            currency: currency,
            chargeSubtotal: chargeSubtotal,
            chargeTotalRealValue: chargeTotalRealValue,
        },
        components: {
            'sigeturbo-financials-accountingentries-show': FinancialAccountingentryShow,
            'sigeturbo-financials-payment-detail': FinancialPaymentDetail,
        },
        data: function () {
            return {
                assets: assets(),
                steps: 3,
                stepSelected: 0,
                receipt: {
                    idreceipt: 0,
                    bank: 2,
                    voucher: 2,
                    consecutive: 0,
                    value: currency(chargeTotalRealValue(this.payments)),
                    date: moment().format('YYYY-MM-DD'),
                },
                vouchertypes: [],
                saveReceiptEnable: true,
                load: false,
            }
        },
        methods: {
            chargeTotalRealValue: chargeTotalRealValue,
            currency: currency,
            titlecase: titlecase,
            closeReceipt() {
                this.$emit('close', false)
            },
            removePayment(position) {
                this.payments.splice(this.payments.indexOf(position), 1);
                this.receipt.value = currency(chargeTotalRealValue(this.payments));
            },
            setStep(step) {
                for (let i = 0; i <= this.steps; i++) {
                    document.getElementById('step-' + i).style.display = "none";
                }
                document.getElementById('step-' + step).style.display = "block";
                //Step Selected
                this.stepSelected = step;
            },
            calculateTotal() {
                this.receipt.value = currency(chargeTotalRealValue(this.payments));
            },
            saveReceipt() {

                //Config Payments
                let data = [];
                this.payments.forEach(function (payment) {
                    let value_real = 0;
                    if (payment.real_method == 'discount') {
                        value_real = payment.value1;
                    } else if (payment.real_method == 'normal') {
                        value_real = payment.value2;
                    } else if (payment.real_method == 'expired') {
                        value_real = payment.value3;
                    }
                    data.push({
                        payment: payment.idpayment,
                        receipt_value: payment.receipt_value,
                        real_value: value_real,
                        method: payment.real_method,
                        ispayment: payment.ispayment,
                    })
                });

                //Save Receipt
                Receipt.save('/api/v1/receipts/', {
                    bank: this.receipt.bank,
                    voucher: this.receipt.voucher,
                    consecutive: this.receipt.consecutive,
                    value: this.receipt.value,
                    date: this.receipt.date,
                    description: this.receipt.description,
                    payments: data,
                }).then(({data}) => {
                    swal({
                        title: uppercase(this.$translate.text('sigeturbo.success')),
                        text: capitalize(this.$translate.text('sigeturbo.receipt_success')),
                        type: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        if (result) {
                            this.saveReceiptEnable = false;
                            //Reload Accountingentry
                            this.receipt.idreceipt = data.receipt.idreceipt;
                            this.load = true;
                            this.$emit('reload');
                            //Get Vouchertypes
                            this.loadVoucherTypes();
                        }
                    });
                }).catch(error => console.log(error));
            },
            loadVoucherTypes() {
                //Get All Voucher Types
                Vouchertype.getVouchertypes({})
                    .then(({data}) => {
                        this.vouchertypes = data;
                        for (let i = 0; i < this.vouchertypes.length; i++) {
                            this.vouchertypes[i].name = titlecase(this.vouchertypes[i].name);
                        }
                        //Get First Consecutive
                        this.receipt.consecutive = data[1].consecutive;
                    })
                    .catch(error => console.log(error));
            }

        },
        watch: {
            'receipt.voucher': function (newVoucher) {
                this.receipt.consecutive = this.vouchertypes[newVoucher - 1].consecutive;
            }
        },
        created() {
            this.loadVoucherTypes();
        },
        mounted() {
        },
    }

</script>