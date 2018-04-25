<template>
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Redaguoti krovinio važtaraštį</h3>
                    </div>
                    <form action="/o/documents" ref="documentsForm" @submit.prevent="updateDocuments()">
                        <div class="box-body">
                            <h2>Pardavėjas</h2>

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
                            <h2>Vairuotojas</h2>

                            <div class="form-group">
                                <label>Vardas, pavardė <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_name' class="form-control" name="user_name"/>
                            </div>

                            <div class="form-group">
                                <label>Automobilio nr. <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_plate' class="form-control" name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
                            </div>

                            <div class="form-group">
                                <label>Priekabos valstybiniai numeriai <sup>*</sup></label>
                                <input type="text" v-model='pivot.user_trailer_plates' class="form-control" name="user_trailer_plates"/>
                                <p class="help-block">Formatas: AA000</p>
                            </div>

                            <div class="form-group">
                                <label>Kelionės lapo nr. <sup>*</sup></label>
                                <input type="number" v-model='doc_KV.user_travel_paper_number' class="form-control" name="user_travel_paper_number"/>
                            </div>
                        </div>

                        <div class="box-body">
                            <h2>Krovinys</h2>

                            <div class="form-group">
                                <label>Tiksli pakrovimo vieta <sup>*</sup></label>
                                <input type="text" v-model='pivot.seller_pick_up_address' class="form-control" name="seller_pick_up_address"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Pakrovimo data <sup>*</sup></label>
                                        <input type="text" v-model='pivot.loadInDate' class="form-control datepicker" name="loadInDate"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Pakrovimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" v-model='pivot.loadInHour' class="form-control" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="loadInHour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" v-model='pivot.loadInMinute' class="form-control" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="loadInMinutes" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Iškrovimo data <sup>*</sup></label>
                                        <input type="text" v-model='pivot.loadOutDate' class="form-control datepicker" name="loadOutDate"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Iškrovimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value='' class="form-control" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="loadOutHour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value='' class="form-control" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="loadOutMinutes" value='00'/>
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
                doc_KV: {}
            };
        },

        methods:
        {
            getDocs: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('docsPivot', targetId, 'kv_id').then((pivot) => {
                    var today = new Date();

                    var dd = today.getDate();
                    var mm = today.getMonth()+1;
                    var yyyy = today.getFullYear();

                    if(dd<10) dd = '0' + dd;
                    if(mm<10) mm = '0' + mm;

                    var todayFormated = yyyy + "-" + mm + "-" + dd;

                    if(!pivot.loadInDate) pivot.loadInDate = todayFormated;
                    if(!pivot.loadInHour) pivot.loadInHour = today.getHours();
                    if(!pivot.loadInMinute) pivot.loadInMinute = today.getMinutes();

                    if(!pivot.loadOutDate) pivot.loadOutDate = todayFormated;

                    _.pivot = pivot;

                    offlineDB.find('doc_KV', targetId, 'id').then((doc_KV) => {
                        _.doc_KV = doc_KV;
                    });
                });
            },

            updateDocuments: function()
            {
                var updatedPivot = {};
                var updatedKV = {};
                var docsForm = $(this.$refs.documentsForm);
                var docsDataArr = docsForm.serializeArray();

                for(var i = 0; i < docsDataArr.length; i++)
                {
                    var docProperty = docsDataArr[i];
                    updatedPivot[docProperty.name] = docProperty.value;
                }

                var mergedKV = Object.assign({}, this.doc_KV, updatedKV);

                mergedKV.user_travel_paper_number = updatedPivot.user_travel_paper_number;
                delete updatedPivot.user_travel_paper_number;

                var mergedPivot = Object.assign({}, this.pivot, updatedPivot);

                mergedPivot.needUpdate = true;

                offlineDB.update("docsPivot", mergedPivot).then(() => {
                    offlineDB.update("doc_KV", mergedKV).then(() => {
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
