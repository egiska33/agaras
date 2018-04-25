<template>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Redaguoti pirkimo pardavimo sutartį</h3>
                    </div>
                    <form action="/o/documents" ref="documentsForm" @submit.prevent="updateDocuments()">
                        <div class="box-body">
                            <h2>Pirkėjo atstovas</h2>

                            <div class="form-group">
                                <label>Vardas, pavardė <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.user_name' name="user_name"/>
                            </div>

                            <div class="form-group">
                                <label>Pareigos <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.user_position' name="user_position"/>
                            </div>
                        </div>

                        <div class="box-body">
                            <h2>Pardavėjas</h2>

                            <div class="form-group">
                                <label>Įmonės pavadinimas arba vardas, pavardė <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.seller_name' name="seller_name"/>
                            </div>

                            <div class="form-group">
                                <label>Įmonės arba asmens kodas <sup>*</sup></label>
                                <input type="number" class="form-control" v-model='pivot.seller_code' disabled/>
                            </div>

                            <div class="form-group">
                                <label>Adresas <sup>*</sup></label>
                                <input type="text" class="form-control" v-model='pivot.seller_address' name="seller_address"/>
                            </div>

                            <div class="form-group">
                                <label>Telefono nr. <sup>*</sup></label>

                                <div class="input-group">
                                    <span class="input-group-addon">+3706</span>
                                    <input type="number" step='1' min='0' v-model='pivot.seller_phone' onKeyPress="if(this.value.length==7) return false;" class="form-control" name="seller_phone"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Fakso nr. <sup>*</sup></label>
                                <input type="number" v-model='pivot.seller_fax' class="form-control" name="seller_fax"/>
                            </div>

                            <div class="form-group">
                                <label>PVM kodas</label>
                                <input type="text" v-model='pivot.seller_pvm_code' class="form-control" name="seller_pvm_code"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Paso numeris </label>
                                        <input type="number" v-model='pivot.seller_pass_series_number' class="form-control"  name="seller_pass_series_number"/>
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
                                <label>Bankas</label>
                                <input type="text" v-model='pivot.seller_bank' class="form-control" name="seller_bank"/>
                            </div>

                            <div class="form-group">
                                <label>Banko sąskaita</label>
                                <input type="text" v-model='pivot.seller_bank_pay_account_number' class="form-control" name="seller_bank_pay_account_number"/>
                            </div>
                        </div>

                        <div class="box-body">
                            <h2>Gyvulių kainos</h2>

                            <div class='row'>
                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>Buliai </label>

                                        <div class="input-group">
                                            <input type="number" v-model='doc_PP.bull_price' step='0.01' min='0' class="form-control" name="bull_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>Telyčios </label>

                                        <div class="input-group">
                                            <input type="number" v-model='doc_PP.heifer_price' step='0.01' min='0' class="form-control" name="heifer_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>Karvės </label>

                                        <div class="input-group">
                                            <input type="number" v-model='doc_PP.cow_price' step='0.01' min='0' class="form-control" name="cow_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
                                        </div>
                                    </div>
                                </div>
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
                pivot: {},
                doc_PP: {}
            };
        },

        methods:
        {
            getDocs: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('docsPivot', targetId, 'pp_id').then((pivot) => {
                    if(!pivot.seller_pvm_code) pivot.seller_pvm_code = 'ne PVM mokėtojas';

                    _.pivot = pivot;

                    offlineDB.find('doc_PP', targetId, 'id').then((doc_PP) => {
                        _.doc_PP = doc_PP;
                    });
                });
            },

            updateDocuments: function()
            {
                var updatedPivot = {};
                var updatedPP = {};
                var docsForm = $(this.$refs.documentsForm);
                var docsDataArr = docsForm.serializeArray();

                for(var i = 0; i < docsDataArr.length; i++)
                {
                    var docProperty = docsDataArr[i];
                    updatedPivot[docProperty.name] = docProperty.value;
                }

                updatedPP.bull_price = updatedPivot.bull_price;
                updatedPP.heifer_price = updatedPivot.heifer_price;
                updatedPP.cow_price = updatedPivot.cow_price;

                delete updatedPivot.bull_price;
                delete updatedPivot.heifer_price;
                delete updatedPivot.cow_price;

                var mergedPP = Object.assign({}, this.doc_PP, updatedPP);
                var mergedPivot = Object.assign({}, this.pivot, updatedPivot);

                mergedPivot.needUpdate = true;

                offlineDB.update("docsPivot", mergedPivot).then(() => {
                    offlineDB.update("doc_PP", mergedPP).then(() => {
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
