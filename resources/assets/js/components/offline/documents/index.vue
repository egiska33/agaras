<template>
    <div>
        <div class="container spark-screen">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="box">
    					<div class="box-header with-border">
    						<h3 class="box-title"><i class="fa fa-book" aria-hidden="true"></i> Dokumentai</h3>
    					</div>
    					<div class="box-body">
    		                <div class="dataTables_wrapper form-inline dt-bootstrap">
    					        <div class="row">
        					    	<div class="col-xs-12 col-sm-5 col-md-6 box-button-group">
        						    	<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#formDocumentsModal'><i class='fa fa-plus'></i> Formuoti dokumentus</a>
        								<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#applicationModal'><i class='fa fa-plus'></i> Kurti paraišką</a>
                                        <a href="/uploads/pricelist.pdf" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> Kainininkas</a>
        					    	</div>
        					    </div>
        					    <div class="row">
        					        <div class="col-sm-12">
        								<form method='GET' class='docsForm' action='/o/documents/print' @click='printAllDocs' @submit.prevent>
        						            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
        						                <thead>
        						                    <tr role="row">
        						                        <th>Pardavėjas</th>
        						                        <th>Kodas</th>
        						                        <th>VG Važtaraštis (pagal gyvą svorį)</th>
        						                        <th>Sąskaita faktūra</th>
        						                        <th>PI Kvitas</th>
        						                        <th>PP Sutartis</th>
        												<th>Krovinio važtaraštis (pagal skerdieną)</th>
        						                        <th>Veiksmai</th>
        						                    </tr>
        						                </thead>
                                                <tbody>
                                                    <tr v-for='doc in docs'>
                                                        <td>{{ doc.seller_name }}</td>
                                                        <td>{{ doc.seller_code }}</td>

                                                        <td class='forceHiddenDesktop'>VG Važtaraštis (pagal gyvą svorį)</td>
                                                        <td class="checkbox-col" v-if='doc.vg_id'>
                                                            <a :href="'/o/documents/animalsWaybill/'+doc.vg_id">Žiūrėti</a>
                                                            <span> / </span>
                                                            <a :href="'/o/documents/animalsWaybill/edit/'+doc.vg_id">Redaguoti</a><br />
                                                            <input type="checkbox" name="vg_id" :value='doc.vg_id'>
                                                        </td>
                                                        <td v-else>
                                                            <span>-</span>
                                                        </td>

                                                        <td class='forceHiddenDesktop'>Sąskaita faktūra</td>
                                                        <td class="checkbox-col" v-if='doc.sf_id'>
                                                            <span v-if='doc.seller_pvm_code'>
                                                                <a :href="'/o/documents/vatInvoice/'+doc.sf_id">Žiūrėti sąskaitą faktūrą.</a>
                                                                <span> / </span>
                                                                <a :href="'/o/documents/vatInvoice/edit/'+doc.sf_id">Redaguoti</a><br />
                                                                <input type="checkbox" name="sf_vat_id" :value='doc.sf_id' />
                                                            </span>
                                                            <span v-else>
                                                                <a :href="'/o/documents/invoice/'+doc.sf_id">Žiūrėti sąskaitą faktūrą.</a>
                                                                <span> / </span>
                                                                <a :href="'/o/documents/vatInvoice/edit/'+doc.sf_id">Redaguoti</a><br />
                                                                <input type="checkbox" name="sf_id" :value='doc.sf_id' />
                                                            </span>
                                                        </td>
                                                        <td v-else>
                                                            <span>-</span>
                                                        </td>

                                                        <td class='forceHiddenDesktop'>PI Kvitas</td>
                                                        <td class="checkbox-col" v-if='doc.pi_id'>
                                                            <a :href="'/o/documents/payoutCheck/'+doc.pi_id">Žiūrėti</a>
                                                            <span> / </span>
                                                            <a :href="'/o/documents/payoutCheck/edit/'+doc.pi_id">Redaguoti</a><br />
                                                            <input type="checkbox" name="pi_id" :value='doc.pi_id'>
                                                        </td>
                                                        <td v-else>
                                                            <span>-</span>
                                                        </td>

                                                        <td class='forceHiddenDesktop'>PP Sutartis</td>
                                                        <td class="checkbox-col" v-if='doc.pp_id'>
                                                            <a :href="'/o/documents/spagreement/'+doc.pp_id">Žiūrėti</a>
                                                            <span> / </span>
                                                            <a :href="'/o/documents/spagreement/edit/'+doc.pp_id">Redaguoti</a><br />
                                                            <input type="checkbox" name="pp_id" :value='doc.pp_id'>
                                                        </td>
                                                        <td v-else>
                                                            <span>-</span>
                                                        </td>

                                                        <td class='forceHiddenDesktop'>Krovinio važtaraštis (pagal skerdieną)</td>
                                                        <td class="checkbox-col" v-if='doc.kv_id'>
                                                            <a :href="'/o/documents/waybill/'+doc.kv_id">Žiūrėti</a>
                                                            <span> / </span>
                                                            <a :href="'/o/documents/waybill/edit/'+doc.kv_id">Redaguoti</a><br />
                                                            <input type="checkbox" name="kv_id" :value='doc.kv_id'>
                                                        </td>
                                                        <td v-else>
                                                            <span>-</span>
                                                        </td>

                                                        <td class='forceHiddenDesktop'>Veiksmai</td>
    							                		<td>
    							                			<input type='submit' value='Spausdinti visus' name='printAll' class="btn btn-sm btn-primary printAllBtn"/>
                                                            <input type='submit' name='printSelected' class="btn printSelectedBtn btn-sm btn-primary" value='Spausdinti pasirinktus'>
    							                			<a v-on:click.prevent="triggerDeleteDocumentsConfirm($event)" :data-delete-id='doc.id' class="btn btn-sm btn-danger button-delete">Ištrinti eilutę</a>
    							                		</td>
                                                    </tr>
                                                </tbody>
        						            </table>
        								</form>
        					        </div>
        					    </div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>

    	<div class="modal fade in" id="formDocumentsModal">
    		<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

    					<h4 class="modal-title">Formuoti dokumentus pardavėjui</h4>
    				</div>

    				<form action="" ref="formDocumentsForm" method='POST' @submit.prevent="formDocuments()">
    					<div class="modal-body">
    						<div class="form-group">
    							<div class="form-group">
    								<label>Ar reikia sugeneruoti PI kvitą? <sup>*</sup></label>

    								<div class='input-group'>
    									<label>
    										<input type="radio" value='1' name="create_pi"/>
    										<span>Taip</span>
    									</label>
    								</div>

    								<div class='input-group'>
    									<label>
    										<input type="radio" value='0' checked='checked' name="create_pi"/>
    										<span>Ne</span>
    									</label>
    								</div>
    			                </div>

    							<label>Pasirinkite pardavėją (šios dienos sukurtų gyv. pardavėjai):</label>

                                <div v-for='todaySeller in todaySellers'>
                                    <label>
        								<input type='radio' name='sellerCode' :value="todaySeller.code" /> <span>{{ todaySeller.name }}</span>
        							</label>
                                </div>

    						</div>
    					</div>

    					<div class="modal-footer">
    						<input type="button" class="btn btn-default pull-left" data-dismiss="modal" value='Uždaryti'>

    						<input type="submit" class="btn btn-primary" value='Formuoti'>
    					</div>
    				</form>
    			</div>
    		</div>
        </div>

    	<div class="modal fade in" id="applicationModal">
    		<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

    					<h4 class="modal-title">Formuoti paraišką</h4>
    				</div>

    				<form action="/o/documents/application/app" method="GET" class='createApplicationForm'>
    					<div class="modal-body">
    						<div class="form-group">
    							<label>Pasirinkite pardavėją (šios dienos sukurtų gyv. pardavėjai):</label>
                                <div class='todaySellersContainer'>
                                    <div v-for='todaySeller in todaySellers'>
            							<label>
            								<input type='checkbox' class='sellerIdInput' name='sellerCodes' :value="todaySeller.code" /> <span>{{ todaySeller.name }}</span>
            								<input type="text" style='display: none;' placeholder='Pardavėjo agentas' name='agents' class="form-control"/>
            							</label>
                                    </div>
                                </div>

    							<div class='row'>
    								<div class='col-xs-12'>
    									<div class="form-group">
    										<label>Supirkėjas <sup>*</sup></label>
    										<input type="text" class="form-control" name="buyer_name"/>
    					                </div>

    									<div class="form-group">
    										<label>Gyvuliai pristatomi iš šių rajonų: <sup>*</sup></label>
    										<textarea style='resize: vertical; min-height: 120px;' type="text" class="form-control" name="buyer_animals_from"></textarea>
    					                </div>

    									<label>Gyvuliai pristatyti į skerdyklą <sup>*</sup></label>

    									<div class='row'>
    		                                <div class='col-xs-12 col-sm-6'>
    		                                    <div class="form-group">
    		        								<input
    													type="text"
    													class="form-control datepicker arriveDateInput"
    													name="buyer_animals_deliver_date"/>
    		                                    </div>
    		                                </div>

    		                                <div class='col-xs-12 col-sm-6'>
    		                                    <input
    												type="number"
    												class="form-control arriveHourInput"
    												min='0' max='23' step='1'
    												onKeyUp="if(this.value > 23) this.value = 23;"
    												onKeyPress="if(this.value.length==2) return false;"
    												name="buyer_animals_deliver_hour"
    												placeholder="valanda"/>
    		                                </div>
    		                            </div>
    								</div>
    							</div>
    						</div>
    					</div>

    					<div class="modal-footer">
    						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Uždaryti</button>

    						<input type="button" v-on:click='parseApplicationSubmit()' class="btn btn-primary submitApplicationBtn" value='Formuoti'>
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
            var _ = this;

            caches.open('agaras-static-v1').then(function(cache)
            {
                cache.add('/uploads/pricelist.pdf');
            });

            var dateObj = new Date();
            var month = dateObj.getMonth() + 1; //months from 1-12
            var day = dateObj.getDate();
            var year = dateObj.getFullYear();

            var newdate = year + "-" + month + "-" + day;
            var thisHour = dateObj.getHours();

            $(".arriveHourInput").val(thisHour);
            $(".arriveDateInput").val(newdate);

            _.getTodaySellers();
            _.getDocuments();
        },

        data: function()
        {
            return {
                todaySellers: [],
                docs: []
            };
        },

        methods:
        {
            printAllDocs: function(elem)
            {
                if($(elem.target).hasClass('printAllBtn'))
                {
                    $(elem.target).parents('tr').siblings().find('input[type="checkbox"]').prop('checked', false);
                    $(elem.target).parents('tr').find('input[type="checkbox"]').prop('checked', true);
                    $(".docsForm").submit();
                }
                else if($(elem.target).hasClass('printSelectedBtn'))
                {
                    if($(elem.target).parents('tr').find('input[type="checkbox"]:checked').length > 0)
                    {
                        $(elem.target).parents('tr').siblings().find('input[type="checkbox"]').prop('checked', false);
                        $(".docsForm").submit();
                    }
                }
            },

            parseApplicationSubmit: function()
            {
                $(".todaySellersContainer").children().each((i, item) => {
                    if(!$(item).find('.sellerIdInput').is(':checked')) $(item).remove();
                });

                $(".createApplicationForm").submit();
            },

            getTodaySellers: function()
            {
                var _ = this;

                var today = new Date;
                today.setHours(0, 0, 0, 0);

                var todayTimestamp = Math.floor(today);
                var insertedSellers = [];

                offlineDB.get('animals', (cursor) => {
                    if(cursor.value.date_created >= todayTimestamp)
                    {
                        offlineDB.find('sellers', Number(cursor.value.seller_code), 'code').then((seller) => {
                            if($.inArray(seller.code, insertedSellers) == -1)
                            {
                                if((seller.phone) && (seller.phone.length) && (seller.pick_up_address) && (seller.pick_up_address.length) && (seller.representative) && (seller.representative.length))
                                {
                                    insertedSellers.push(seller.code);
                                    _.todaySellers.push(seller);
                                }
                            }
                        });
                    }
                });
            },

            getDocuments: function()
            {
                var _ = this;

                offlineDB.get('docsPivot', function(cursor)
                {
                    var pivotDoc = cursor.value;

                    _.docs.push(pivotDoc);
                }).then(() => {
                    _.docs.sort(function(a,b) {
                        return (a.id > b.id) ? -1 : ((b.id > a.id) ? 1 : 0);
                    });
                });
            },

            triggerDeleteDocumentsConfirm: function(event)
            {
                if(confirm("Ar tikrai norite ištrinti dokumentų eilutę?")) this.deleteDocuments($(event.target).data('delete-id'));
            },

            deleteDocuments: function(targetDeleteId)
            {
                let _ = this;
                let targetPivot = $.grep(_.docs, function(e){ return e.id == targetDeleteId; })[0];


                if(targetPivot.vg_id) offlineDB.delete('doc_VG', Number(targetPivot.vg_id), 'id');
                if(targetPivot.pp_id) offlineDB.delete('doc_PP', Number(targetPivot.pp_id), 'id');
                if(targetPivot.pi_id) offlineDB.delete('doc_PI', Number(targetPivot.pi_id), 'id');
                if(targetPivot.sf_id) offlineDB.delete('doc_SF', Number(targetPivot.sf_id), 'id');
                if(targetPivot.kv_id) offlineDB.delete('doc_KV', Number(targetPivot.kv_id), 'id');
                offlineDB.delete('docsPivot', Number(targetDeleteId), 'id');

                location.reload();
            },

            formDocuments: function()
            {
                var formDocuments = {};

                var formDocumentsForm = $(this.$refs.formDocumentsForm);
                var formDocumentsDataArr = formDocumentsForm.serializeArray();

                for(var i = 0; i < formDocumentsDataArr.length; i++)
                {
                    var formDocumentsProperty = formDocumentsDataArr[i];
                    formDocuments[formDocumentsProperty.name] = formDocumentsProperty.value;
                }

                if(typeof formDocuments.sellerCode === 'undefined') return;
                formDocuments.sellerCode = Number(formDocuments.sellerCode);

                offlineDB.find('driver', 1, 'id').then((driver) => {
                    offlineDB.find('sellers', formDocuments.sellerCode, 'code').then((seller) => {
                        var docsPivot = {};

                        docsPivot.user_name = driver.name;
                        docsPivot.user_phone = driver.phone;
                        docsPivot.user_plate = driver.plate;
                        docsPivot.user_position = driver.position;
                        docsPivot.user_trailer_plates = driver.trailer_plates;

                        docsPivot.seller_name = seller.name;
                        docsPivot.seller_code = seller.code;
                        docsPivot.seller_address = seller.address;
                        docsPivot.seller_pvm_code = seller.pvm_code;
                        docsPivot.seller_phone = seller.phone;
                        docsPivot.seller_pvm_rate = seller.pvm_rate;
                        docsPivot.seller_pick_up_address = seller.pick_up_address;
                        docsPivot.seller_representative = seller.representative;
                        docsPivot.seller_pass_issued_date = seller.pass_issued_date;
                        docsPivot.seller_pass_series_number = seller.pass_series_number;
                        docsPivot.seller_post_code = seller.post_code;
                        docsPivot.seller_email = seller.email;
                        docsPivot.seller_fax = seller.fax;
                        docsPivot.seller_bank = seller.bank;
                        docsPivot.seller_bank_pay_account_number = seller.bank_pay_account_number;


                        docsPivot.travel_start_date = seller.travel_start_date;
                        docsPivot.travel_start_hour = seller.travel_start_hour;
                        docsPivot.travel_start_minute = seller.travel_start_minute;
                        docsPivot.loadInDate = seller.travel_start_date;
                        docsPivot.loadInHour = seller.travel_start_hour;
                        docsPivot.loadInMinute = seller.travel_start_minute;


                        docsPivot.travel_duration = seller.travel_duration;


                        docsPivot.travel_arrive_date = seller.travel_arrive_date;
                        docsPivot.travel_arrive_hour = seller.travel_arrive_hour;
                        docsPivot.travel_arrive_minute = seller.travel_arrive_minute;
                        docsPivot.loadInDate = seller.travel_arrive_date;
                        docsPivot.loadInHour = seller.travel_arrive_hour;
                        docsPivot.loadInMinute = seller.travel_arrive_minute;

                        var animalsHerdArr = [];
                        var hasInclination = false;
                        var isSlaughtered = false;

                        offlineDB.get('animals', function(animalCursor)
                        {
                            var currAnimal = animalCursor.value;

                            if(currAnimal.seller_code == formDocuments.sellerCode)
                            {
                                if(animalCursor.value.inclination > 0) hasInclination = true;
                                if(animalCursor.value.inclination == 0) isSlaughtered = true;

                                if((animalCursor.value.herd_number) && (jQuery.inArray(animalCursor.value.herd_number, animalsHerdArr) === -1)) animalsHerdArr.push(animalCursor.value.herd_number);
                            }
                        }).then(() => {
                            docsPivot.animal_herd_number = animalsHerdArr.join(', ');
                            var totalAnimalsPriceField = 0

                            offlineDB.findWhere('animals', formDocuments.sellerCode, 'seller_code', (animalCursor) => {
                                if(animalCursor.value.inclination > 0) hasInclination = true;
                                if(animalCursor.value.inclination == 0) isSlaughtered = true;


                                var currAnimal = animalCursor.value;

                                var pricePer100Kg = Math.round((parseFloat(currAnimal.includable_weight) * parseFloat(currAnimal.price_kg)) * 100) / 100;
                                if(isNaN(pricePer100Kg)) pricePer100Kg = 0;
                                totalAnimalsPriceField += pricePer100Kg;
                            }).then(() => {
                                offlineDB.find('docSerials', 1, 'id').then((oldSerials) => {
                                    let needSerialUpdate = {
                                        kv: false,
                                        sf: false,
                                        pp: false,
                                        pi: false
                                    };

                                    if(isSlaughtered)
                                    {
                                        let docKVNo = Number(oldSerials.waybill_number) + 1;
                                        if(String(oldSerials.waybill_number).charAt(0) == '0') docKVNo = ('000000'+(Number(oldSerials.waybill_number) + 1)).slice(-6);
                                        var docKV = {
                                            serial: oldSerials.waybill_serial,
                                            no: docKVNo
                                        };

                                        var insertKV = offlineDB.insert('doc_KV', docKV).then((insertedKVId) => {
                                            docsPivot.kv_id = insertedKVId;
                                        });

                                        needSerialUpdate.kv = true;

                                        let docPPNo = Number(oldSerials.sp_agreement_number) + 1;
                                        if(String(oldSerials.sp_agreement_number).charAt(0) == '0') docPPNo = ('000000'+(Number(oldSerials.sp_agreement_number) + 1)).slice(-6);
                                        var docPP = {
                                            serial: oldSerials.sp_agreement_serial,
                                            no: docPPNo
                                        };

                                        var insertPP = offlineDB.insert('doc_PP', docPP).then((insertedPPId) => {
                                            docsPivot.pp_id = insertedPPId;
                                        });

                                        needSerialUpdate.pp = true;
                                    }

                                    if(hasInclination)
                                    {
                                        if(docsPivot.seller_pvm_code)
                                        {
                                            let docSFPNoVAT = Number(oldSerials.vat_invoice_number) + 1;
                                            if(String(oldSerials.vat_invoice_number).charAt(0) == '0') docSFPNoVAT = ('0000000'+(Number(oldSerials.vat_invoice_number) + 1)).slice(-7);
                                            var docSF = {
                                                serial_vat: oldSerials.vat_invoice_serial,
                                                no_vat: docSFPNoVAT
                                            };

                                            var insertSF = offlineDB.insert('doc_SF', docSF).then((insertedSFId) => {
                                                docsPivot.sf_id = insertedSFId;
                                            });
                                        }
                                        else
                                        {
                                            let docSFPNo = Number(oldSerials.invoice_number) + 1;
                                            if(String(oldSerials.invoice_number).charAt(0) == '0') docSFPNo = ('000000'+(Number(oldSerials.invoice_number) + 1)).slice(-6);
                                            var docSF = {
                                                farmer_pass_number: seller.farmer_pass_number,
                                                serial: oldSerials.invoice_serial,
                                                no: docSFPNo
                                            };

                                            var insertSF = offlineDB.insert('doc_SF', docSF).then((insertedSFId) => {
                                                docsPivot.sf_id = insertedSFId;
                                            });

                                            needSerialUpdate.sf = true;
                                        }
                                    }

                                    if(formDocuments.create_pi == '1')
                                    {
                                        let docPIPNo = Number(oldSerials.payout_check_number) + 1;
                                        if(String(oldSerials.payout_check_number).charAt(0) == '0') docPIPNo = ('000000'+(Number(oldSerials.payout_check_number) + 1)).slice(-6);
                                        var docPI = {
                                            serial: oldSerials.payout_check_serial,
                                            no: docPIPNo
                                        };

                                        var totalPrice = 0;

                                        if(docsPivot.seller_pvm_code)
                                        {
                                            if(docsPivot.seller_pvm_rate == '21') totalPrice = (totalAnimalsPriceField * 1.21).toFixed(2);
                                            else if(docsPivot.seller_pvm_rate == '6') totalPrice = (totalAnimalsPriceField * 1.06).toFixed(2);
                                            else totalPrice = totalAnimalsPriceField;
                                        }
                                        else totalPrice = totalAnimalsPriceField;

                                        var euroAmount = (totalPrice+'').split('.')[0];
                                        var centsAmount = (totalPrice+'').split('.')[1];
                                        if(!centsAmount) centsAmount = 0;

                                        docPI.totalAmount = totalPrice;
                                        docPI.euroAmount = euroAmount;
                                        docPI.centsAmount = centsAmount;

                                        var insertPI = offlineDB.insert('doc_PI', docPI).then((insertedPIId) => {
                                            docsPivot.pi_id = insertedPIId;
                                        });
                                        needSerialUpdate.pi = true;
                                    }

                                    var docVG = {};
                                    var insertVG = offlineDB.insert('doc_VG', docVG).then((insertedVGId) => {
                                        docsPivot.vg_id = insertedVGId;
                                    });

                                    docsPivot.needSync = true;
                                    docsPivot.needUpdate = false;

                                    if(needSerialUpdate.kv) oldSerials.waybill_number = docKV.no;
                                    if(needSerialUpdate.sf)
                                    {
                                        if(docsPivot.seller_pvm_code) oldSerials.vat_invoice_number = docSF.no_vat;
                                        else oldSerials.invoice_number = docSF.no;
                                    }
                                    if(needSerialUpdate.pp) oldSerials.sp_agreement_number = docPP.no;
                                    if(needSerialUpdate.pi) oldSerials.payout_check_number = docPI.no;

                                    offlineDB.update('docSerials', oldSerials).then(() => {
                                        Promise.all([insertKV, insertPP, insertSF, insertPI, insertVG]).then(() => {

                                            offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
                                                flags.docsInsert = true;

                                                var updatePromises = [];

                                                updatePromises.push(offlineDB.update('docsPivot', docsPivot));
                                                updatePromises.push(offlineDB.update('syncTableFlags', flags));

                                                Promise.all(updatePromises).then(() => {
                                                    location.reload();
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            }
        }
    }
</script>
