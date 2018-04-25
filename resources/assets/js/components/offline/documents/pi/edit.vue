<template>
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Redaguoti pinigų išmokėjimo kvitą</h3>
					</div>
					<form action="/o/documents" ref="documentsForm" @submit.prevent="updateDocuments()">
						<div class="box-body">
                            <label>Išmokėta suma</label>

                            <div class='row'>
                                <div class='col-xs-6 col-sm-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" v-model='doc_PI.euroAmount' step='1' min='0' class="form-control" name="euroAmount"/>
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-6 col-sm-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" v-model='doc_PI.centsAmount' onKeyPress="if(this.value.length==2) return false;" step='1' min='0' max='99' class="form-control" name="centsAmount"/>
                                            <span class="input-group-addon">ct</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<label>Išmokėjusio vairuotojo vardas, pavardė<sup>*</sup></label>
								<input type="text" class="form-control" v-model='pivot.user_name' name="user_name"/>
			                </div>
						</div>

                        <div class="box-body">
                            <h2>Pardavėjas</h2>

                            <div class="form-group">
								<label>Asmens kodas <sup>*</sup></label>
								<input type="number" class="form-control" v-model='pivot.seller_code' disabled/>
			                </div>

                            <div class="form-group">
								<label>Paso numeris <sup>*</sup></label>
								<input type="number" class="form-control" v-model='pivot.seller_pass_series_number' name="seller_pass_series_number"/>
			                </div>

                            <div class="form-group">
								<label>Gyvenamosios vietos adresas <sup>*</sup></label>
								<input type="text" class="form-control" v-model='pivot.seller_address' name="seller_address"/>
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
                doc_PI: {}
            };
        },

        methods:
        {
            getDocs: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('docsPivot', targetId, 'pi_id').then((pivot) => {
                    _.pivot = pivot;

                    offlineDB.find('doc_PI', targetId, 'id').then((doc_PI) => {
                        _.doc_PI = doc_PI;
                    });
                });
            },

            updateDocuments: function()
            {
                var updatedPivot = {};
                var updatedPI = {};
                var docsForm = $(this.$refs.documentsForm);
                var docsDataArr = docsForm.serializeArray();

                for(var i = 0; i < docsDataArr.length; i++)
                {
                    var docProperty = docsDataArr[i];
                    updatedPivot[docProperty.name] = docProperty.value;
                }

                updatedPI.check_number = updatedPivot.check_number;
                updatedPI.paid_for = updatedPivot.paid_for;
                updatedPI.invoice_number = updatedPivot.invoice_number;
                updatedPI.euroAmount = updatedPivot.euroAmount;
                updatedPI.centsAmount = updatedPivot.centsAmount;

                delete updatedPivot.check_number;
                delete updatedPivot.paid_for;
                delete updatedPivot.invoice_number;
                delete updatedPivot.euroAmount;
                delete updatedPivot.centsAmount;

                var mergedPI = Object.assign({}, this.doc_PI, updatedPI);
                var mergedPivot = Object.assign({}, this.pivot, updatedPivot);

                mergedPivot.needUpdate = true;

                offlineDB.update("docsPivot", mergedPivot).then(() => {
                    offlineDB.update("doc_PI", mergedPI).then(() => {
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
