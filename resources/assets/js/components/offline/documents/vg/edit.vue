<template>
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Redaguoti važtaraštį</h3>
					</div>
					<form action="/o/documents" ref="documentsForm" @submit.prevent="updateDocuments()">
						<div class="box-body">
                            <h2>Redaguoti važtaraštį</h2>

                            <div class="form-group">
								<label>Vardas, pavardė arba įmonės pavadinimas <sup>*</sup></label>
								<input type="text" class="form-control sellerNameInput" v-model='pivot.seller_name' name="seller_name"/>
			                </div>

                            <div class="form-group">
								<label>Įmonės arba asmens kodas <sup>*</sup></label>
								<input type="number" class="form-control" disabled v-model='pivot.seller_code'/>
			                </div>

                            <div class="form-group">
								<label>Gyvenamasis rajonas, savivaldybė, seniūnija, vietovė, gatvė, namo numeris <sup>*</sup></label>
								<input type="text" class="form-control sellerAddressInput" v-model='pivot.seller_address' name="seller_address"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>Pardavėjo atstovas</h2>
                            <div class="form-group">
                                <label>
                                    <div class="checkbox inline">
                                      <label>
                                          <input type="checkbox" @click='handleSameNameChange'> Pardavėjas sutampa su aukščiau nurodytu
                                      </label>
                                    </div>
                                </label>
                                <input type="text" class="form-control sellerRepresentative" name="seller_representative" v-model="pivot.seller_representative">
                            </div>
                            <h2>Gyvuliai</h2>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Laikymo vietos numeris <sup>*</sup></label>
        								<input type="number" v-model='pivot.animal_place_number' class="form-control" name="held_place_number"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Bandos numeris <sup>*</sup></label>
        								<input type="text" v-model='pivot.animal_herd_number' class="form-control" name="animal_herd_number"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<label>
                                    Laikymo vietos adresas
                                    <div class="checkbox inline">
                                        <label>
                                            <input type="checkbox" @click='handleSameAddressChange' /> Adresas sutampa su aukščiau nurodytu
                                        </label>
                                    </div>
                                </label>
								<input type="text" v-model='pivot.seller_pick_up_address' class="form-control" name="seller_pick_up_address"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>Kelionė</h2>

                            <div class="form-group">
								<label>Gyvulių vežėjo veterinarinio patvirtinimo Nr. <sup>*</sup></label>
								<input type="number" v-model='doc_VG.vet_pass_number' class="form-control" name="vet_pass_number"/>
			                </div>

                            <div class="form-group">
								<label>Automobilio nr. <sup>*</sup></label>
								<input type="text" class="form-control" v-model='pivot.user_plate' name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
			                </div>

                            <div class="form-group">
								<label>Priekabos valstybiniai numeriai <sup>*</sup></label>
								<input type="text" class="form-control" v-model='pivot.user_trailer_plates' name="user_trailer_plates"/>
                                <p class="help-block">Formatas: AA000</p>
			                </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Išvykimo data <sup>*</sup></label>

        								<input type="text" class="form-control leaveDateInput" v-model='pivot.travel_start_date' name="travel_start_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Išvykimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" v-model='pivot.travel_start_hour' class="form-control leaveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" v-model='pivot.travel_start_minute' class="form-control leaveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Planuojama kelionės trukmė (val.) <sup>*</sup></label>
                                <select v-model='pivot.travel_duration' @change='recalculateArriveDate' name='travel_duration' class='form-control'>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                    <option value='6'>6</option>
                                    <option value='7'>7</option>
                                    <option value='8'>8</option>
                                </select>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Planuojama atvykimo data <sup>*</sup></label>
        								<input type="text"  v-model='pivot.travel_arrive_date' class="form-control datepicker arriveDateInput" name="travel_arrive_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Planuojamas atvykimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" v-model='pivot.travel_arrive_hour' class="form-control arriveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" v-model='pivot.travel_arrive_minute' class="form-control arriveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_minute" value='00'/>
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
            var _ = this
            _.getDocs();

            $(document).ready(function()
        	{
                $(".leaveDateInput").datepicker({
        			format: 'yyyy-mm-dd',
        			language: 'lt',
        			autoclose: true,
        			showOnFocus: false
        		}).on('changeDate', () => {
                    _.recalculateArriveDate();
                }).on('click', function()
        		{
        			$(this).datepicker('show');
        		});
            });
        },

        data: function()
        {
            return {
                pivot: {
                    travel_start_date: null,
                    travel_start_hour: null,
                    travel_start_minute: null
                },
                doc_VG: {}
            };
        },

        methods:
        {
            handleSameNameChange: function(e)
            {
                var _ = this;

                if($(e.target).is(':checked')) Vue.set(_.seller, 'seller_representative',  $('.sellerNameInput').val());
                else _.seller.seller_representative = '';
            },

            handleSameAddressChange: function(e)
            {
                var _ = this;

                if($(e.target).is(':checked')) _.pivot.seller_pick_up_address = $('.sellerAddressInput').val();
                else _.pivot.seller_pick_up_address = '';
            },

            recalculateArriveDate: function()
            {
                var _ = this;

                Vue.set(_.pivot, 'travel_start_date', $('.leaveDateInput').val());

                var arriveDate = new Date(_.pivot.travel_start_date);
                var forwardTime = Number(_.pivot.travel_start_hour) + Number(_.pivot.travel_duration);
                arriveDate.setHours(forwardTime);
                arriveDate.setMinutes(_.pivot.travel_start_minute);

                var arrivedd = arriveDate.getDate();
                var arrivemm = arriveDate.getMonth()+1;
                var arriveyyyy = arriveDate.getFullYear();

                if(arrivedd<10) arrivedd = '0' + arrivedd;
                if(arrivemm<10) arrivemm = '0' + arrivemm;

                var arriveFormated = arriveyyyy + "-" + arrivemm + "-" + arrivedd;

                _.pivot.travel_arrive_date = arriveFormated;
                _.pivot.travel_arrive_hour = arriveDate.getHours();
                _.pivot.travel_arrive_minute = arriveDate.getMinutes();
            },

            getDocs: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('docsPivot', targetId, 'vg_id').then((pivot) => {
                    var addMinutes = (date, minutes) => {
                        return new Date(date.getTime() + minutes*60000);
                    }

                    var today = new Date();
                    today = addMinutes(today, 30);

                    var dd = today.getDate();
                    var mm = today.getMonth()+1;
                    var yyyy = today.getFullYear();

                    if(dd<10) dd = '0' + dd;
                    if(mm<10) mm = '0' + mm;

                    var todayFormated = yyyy + "-" + mm + "-" + dd;

                    if(!pivot.travel_start_date) pivot.travel_start_date = todayFormated;
                    if(!pivot.travel_start_hour) pivot.travel_start_hour = today.getHours();
                    if(!pivot.travel_start_minute) pivot.travel_start_minute = today.getMinutes();

                    if(!pivot.travel_duration) pivot.travel_duration = 0;


                    var arriveDate = today;
                    arriveDate.setHours(arriveDate.getHours() + pivot.travel_duration);

                    var arrivedd = arriveDate.getDate();
                    var arrivemm = arriveDate.getMonth()+1;
                    var arriveyyyy = arriveDate.getFullYear();

                    if(arrivedd<10) arrivedd = '0' + arrivedd;
                    if(arrivemm<10) arrivemm = '0' + arrivemm;

                    var arriveFormated = arriveyyyy + "-" + arrivemm + "-" + arrivedd;

                    if(!pivot.travel_arrive_date) pivot.travel_arrive_date = arriveFormated;
                    if(!pivot.travel_arrive_hour) pivot.travel_arrive_hour = arriveDate.getHours();
                    if(!pivot.travel_arrive_minute) pivot.travel_arrive_minute = arriveDate.getMinutes();

                    _.pivot = pivot;

                    offlineDB.find('doc_VG', targetId, 'id').then((doc_VG) => {
                        _.doc_VG = doc_VG;
                    });
                });
            },

            updateDocuments: function()
            {
                var updatedPivot = {};
                var updatedVG = {};
                var docsForm = $(this.$refs.documentsForm);
                var docsDataArr = docsForm.serializeArray();

                for(var i = 0; i < docsDataArr.length; i++)
                {
                    var docProperty = docsDataArr[i];
                    updatedPivot[docProperty.name] = docProperty.value;
                }

                updatedVG.sex = updatedPivot.sex;
                updatedVG.held_place_number = updatedPivot.held_place_number;
                updatedVG.herd_number = updatedPivot.herd_number;
                updatedVG.vet_pass_number = updatedPivot.vet_pass_number;
                updatedVG.travel_duration = updatedPivot.travel_duration;

                delete updatedPivot.sex;
                delete updatedPivot.held_place_number;
                delete updatedPivot.herd_number;
                delete updatedPivot.vet_pass_number;
                delete updatedPivot.travel_duration;

                var mergedVG = Object.assign({}, this.doc_VG, updatedVG);
                var mergedPivot = Object.assign({}, this.pivot, updatedPivot);

                mergedPivot.needUpdate = true;

                offlineDB.update("docsPivot", mergedPivot).then(() => {
                    offlineDB.update("doc_VG", mergedVG).then(() => {
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
