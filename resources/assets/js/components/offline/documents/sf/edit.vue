<template>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Redaguoti sąskaitą faktūrą</h3>
                    </div>
                    <form action="/o/documents" ref="documentsForm" @submit.prevent="updateDocuments()">
                        <div class="box-body">
                            <h2>Pardavėjas</h2>

                            <div class="form-group">
                                <label>Vardas, pavardė <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.seller_representative' name="seller_representative"/>
                            </div>

                            <div class="form-group">
                                <label>Pareigos <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.seller_position' name="seller_position"/>
                            </div>

                            <div class="form-group">
                                <label>Įmonės arba asmens kodas <sup>*</sup></label>
                                <input type="number" class="form-control" v-model='pivot.seller_code' disabled/>
                            </div>

                            <div class="form-group">
                                <label>PVM mokėtojo kodas <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.seller_pvm_code' name="seller_pvm_code"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Paso numeris </label>
                                        <input type="number" v-model='pivot.seller_pass_series_number' class="form-control" name="seller_pass_series_number"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Paso išdavimo data </label>
                                        <input type="text" v-model='pivot.seller_pass_issued_date' class="form-control datepicker" name="seller_pass_issued_date"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Bankas <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_bank' class="form-control" name="seller_bank"/>
                            </div>

                            <div class="form-group">
                                <label>Atsiskaitomosios banko sąskaitos nr. <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_bank_pay_account_number' class="form-control" name="seller_bank_pay_account_number"/>
                            </div>

                            <div class="form-group">
                                <label>Ūkininko pažymėjimo nr. <sup>*</sup></label>
                                <input type="number" min='0' v-model='doc_SF.farmer_pass_number' class="form-control" name="farmer_pass_number"/>
                            </div>

                            <div class="form-group">
                                <label>Automobilio nr. <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_plate' class="form-control" name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
                            </div>

                            <div class="form-group">
                                <label>Pakrovimo adresas <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_pick_up_address' class="form-control" name="seller_pick_up_address"/>
                            </div>

                            <div class="form-group">
                                <label>Pakrovimo data <sup>*</sup></label>
                                <input type="text" v-model='pivot.travel_start_date' class="form-control datepicker" name="travel_start_date"/>
                            </div>

                            <h3>Juridinis arba fizinis asmuo</h3>

                            <div class="form-group">
                                <label>Vardas, pavardė / pavadinimas <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_name' class="form-control" name="seller_name"/>
                            </div>

                            <div class="form-group">
                                <label>Adresas <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_address' class="form-control" name="seller_address"/>
                            </div>

                            <div class="form-group">
                                <label>Telefono nr. <sup>*</sup></label>

                                <div class="input-group">
                                    <span class="input-group-addon">+3706</span>
                                    <input type="number" v-model='pivot.seller_phone' step='1' min='0' onKeyPress="if(this.value.length==7) return false;" class="form-control" name="seller_phone"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Fakso nr. <sup>*</sup></label>
                                <input type="number" v-model='pivot.seller_fax' class="form-control" name="seller_fax"/>
                            </div>

                            <div class="form-group">
                                <label>El. paštas <sup>*</sup></label>
                                <input type="email" v-model='pivot.seller_email' class="form-control" name="seller_email"/>
                            </div>
                        </div>

                        <div class="box-body">
                            <h2>Pirkėjas</h2>

                            <div class="form-group">
                                <label>Vairuotojo vardas, pavardė <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_name' class="form-control" name="user_name"/>
                            </div>

                            <div class="form-group">
                                <label>Pareigos <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_position' class="form-control" name="user_position"/>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-block btn-primary">Išsaugoti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted: function()
        {
            this.getDocs();
        },

        data: function()
        {
            return {
                pivot: {
                    travel_start_date: ''
                },
                doc_SF: {}
            };
        },

        methods:
        {
            getDocs: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('docsPivot', targetId, 'sf_id').then((pivot) => {
                    _.pivot = pivot;

                    offlineDB.find('doc_SF', targetId, 'id').then((doc_SF) => {
                        _.doc_SF = doc_SF;
                    });
                });
            },

            updateDocuments: function()
            {
                var updatedPivot = {};
                var updatedSF = {};
                var docsForm = $(this.$refs.documentsForm);
                var docsDataArr = docsForm.serializeArray();

                for(var i = 0; i < docsDataArr.length; i++)
                {
                    var docProperty = docsDataArr[i];
                    updatedPivot[docProperty.name] = docProperty.value;
                }

                updatedSF.farmer_pass_number = updatedPivot.farmer_pass_number;

                delete updatedPivot.farmer_pass_number;

                var mergedSF = Object.assign({}, this.doc_SF, updatedSF);
                var mergedPivot = Object.assign({}, this.pivot, updatedPivot);

                mergedPivot.needUpdate = true;

                offlineDB.update("docsPivot", mergedPivot).then(() => {
                    offlineDB.update("doc_SF", mergedSF).then(() => {
                        offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
                            flags.docsUpdate = true;

                            offlineDB.update('syncTableFlags', flags).then().then(() => {
                                formURL(docsForm.attr('action'));
                            });
                        });
                    });
                });
            }
        }
    }
</script>
