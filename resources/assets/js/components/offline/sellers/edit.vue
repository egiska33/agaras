<template>
    <div class="container spark-screen">
        <div class='row'>
            <div class="col-xs-12 col-md-8 col-md-offset-2 formErrors">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <form action="/o/sellers" ref="sellerForm" @submit.prevent="updateSeller()">
                        <div class="box-header with-border">
                            <h3 class="box-title">Redaguoti pardavėją</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label>Vardas, pavardė arba įmonės pavadinimas <sup>*</sup></label>
                                <input type="text" class="form-control sellerNameInput" disabled :value="seller.name">
                            </div>
                            <div class="form-group">
                                <label>Asmens / įmonės Kodas <sup>*</sup></label>
                                <input type="text" class="form-control" disabled :value="seller.code">
                            </div>
                            <div class="form-group">
                                <label>Adresas <sup>*</sup></label>
                                <input type="text" class="form-control sellerAddressInput" disabled :value="seller.address">
                            </div>
                            <div class="form-group">
								<label>Pašto kodas </label>
								<input type="text" class="form-control" name="post_code" v-model="seller.post_code">
			                </div>

                            <div class="form-group">
                                <label>
                                    Pardavėjo atstovas
                                    <div class="checkbox inline">
                                      <label>
                                          <input type="checkbox" @click='handleSameNameChange'> Pardavėjas sutampa su aukščiau nurodytu
                                      </label>
                                    </div>
                                </label>
                                <input type="text" class="form-control sellerRepresentative" name="representative" v-model="seller.representative">
                            </div>

                            <div class="form-group">
                                <label>
                                    Laikymo adresas/pakrovimo vieta
                                    <div class="checkbox inline">
                                      <label>
                                          <input type="checkbox" @click='handleSameAddressChange'> Adresas sutampa su aukščiau nurodytu
                                      </label>
                                    </div>
                                </label>
                                <input type="text" class="form-control pickUpAddressInput" name="pick_up_address" v-model="seller.pick_up_address">
                            </div>

                            <div class="form-group">
                                <label>PVM kodas</label>
                                <input type="text" class="form-control" name="pvm_code" v-model="seller.pvm_code">
                            </div>

                            <div class="checkbox">
				                <label><input checked='checked' v-model='seller.has_exemption' type="checkbox" name='has_exemption' /> <span>Taikoma speciali PVM apmokestinamojo momento nustatymo tvarka</span></label>
				            </div>

			                <div class="form-group">
								<label>PVM tarifas</label>
								<select v-model='seller.pvm_rate' name="pvm_rate" class="form-control">
									<option value="">-</option>
									<option value="0">0</option>
									<option value="6">6</option>
									<option value="21">21</option>
								</select>
			                </div>

                            <div class="form-group">
                                <label>El. paštas</label>
                                <input type="email" v-model='seller.email' class="form-control" name="email"/>
                            </div>

                            <div class="form-group">
                                <label>Ūkininko pažymėjimo nr.</label>
                                <input type="number" min='0' v-model='seller.farmer_pass_number' class="form-control" name="farmer_pass_number"/>
                            </div>

                            <div class="form-group">
                                <label>Mob. nr. <sup>*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        +3706
                                    </div>
                                    <input type="number" class="form-control" name="phone" v-model="seller.phone">
                                </div>
                            </div>

                            <div class="form-group">
								<label>Planuojama išvykimo data</label>
								<input type="text" class="form-control datepicker" data-date-end-date="" value="">
							</div>

                            <div class="form-group">
                                <label>Bankas</label>
                                <input type="text" v-model='seller.bank' class="form-control" name="bank"/>
                            </div>

                            <div class="form-group">
                                <label>Banko sąskaita</label>
                                <input type="text" v-model='seller.bank_pay_account_number' class="form-control" name="bank_pay_account_number"/>
                            </div>

                            <div class="form-group">
                                <label>Fakso nr.</label>
                                <input type="number" v-model='seller.fax' class="form-control" name="fax"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Paso numeris</label>
                                        <input type="number" class="form-control" v-model="seller.pass_series_number" name="pass_series_number"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Paso išdavimo data</label>
                                        <input type="text" class="form-control datepicker" v-model="seller.pass_issued_date" name="pass_issued_date"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <h2>Kelionė</h2>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Išvykimo data <sup>*</sup></label>

                                        <input type="text" class="form-control leaveDateInput" v-model='seller.travel_start_date' name="travel_start_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Išvykimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" v-model='seller.travel_start_hour' class="form-control leaveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" v-model='seller.travel_start_minute' class="form-control leaveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Planuojama kelionės trukmė (val.) <sup>*</sup></label>
                                <select v-model='seller.travel_duration' @change='recalculateArriveDate' name='travel_duration' class='form-control'>
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
                                        <input type="text"  v-model='seller.travel_arrive_date' class="form-control datepicker arriveDateInput" name="travel_arrive_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>Planuojamas atvykimo laikas <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" v-model='seller.travel_arrive_hour' class="form-control arriveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" v-model='seller.travel_arrive_minute' class="form-control arriveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-header with-border">
                            <h3 class="box-title">Gyvulių laikymo sąlygos</h3>
                        </div>
                        <div class="box-body">
                            <h4>Ūkyje naudojami pašarai</h4>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" class='sienas' name="fooder[]" value="Šienas">Šienas</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='sienainis' name="fooder[]" value="Šienainis">Šienainis</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='silosas' name="fooder[]" value="Silosas">Silosas</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='siaudai' name="fooder[]" value="Šiaudai">Šiaudai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='koncentratai' name="fooder[]" value="Koncentratai">Koncentratai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='sakniavaisiai' name="fooder[]" value="Šakniavaisiai">Šakniavaisiai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class='isspaudos' name="fooder[]" value="Išspaudos">Išspaudos</label>
                                </div>
                                <div class="checkbox">
                                    <label><input id="other-checkbox" class='kita' type="checkbox" name="fooder[]" value="Kita">Kita (Įrašyti)</label><input type="text" class="form-control other-input" name="otherFooder" v-model='seller.otherFooder'>
                                </div>
                            </div>
                            <h4>Gyvulių gerovės vertinimas</h4>
                            <div class="form-group">
                                <div class="radio">
                                    <label v-if='seller.prosperity_evaluation === "Gerai"'><input type="radio" checked name="prosperity_evaluation" value="Gerai">Gerai</label>
                                    <label v-else><input type="radio" name="prosperity_evaluation" value="Gerai">Gerai</label>
                                </div>
                                <div class="radio">
                                    <label v-if='seller.prosperity_evaluation === "Patenkinamai"'><input type="radio" checked name="prosperity_evaluation" value="Patenkinamai">Patenkinamai</label>
                                    <label v-else><input type="radio" name="prosperity_evaluation" value="Patenkinamai">Patenkinamai</label>
                                </div>
                                <div class="radio">
                                    <label v-if='seller.prosperity_evaluation === "Blogai"'><input type="radio" checked name="prosperity_evaluation" value="Blogai">Blogai</label>
                                    <label v-else><input type="radio" name="prosperity_evaluation" value="Blogai">Blogai</label>
                                </div>
                            </div>
                            <h4>Užauginimo vieta</h4>
                            <div class="form-group">
                                <div class="radio">
                                    <label v-if='seller.possesion === "Laikomi palaidi"'><input type="radio" checked name="possesion" value="Laikomi palaidi">Laikomi palaidi</label>
                                    <label v-else><input type="radio" name="possesion" value="Laikomi palaidi">Laikomi palaidi</label>
                                </div>
                                <div class="radio">
                                    <label v-if='seller.possesion === "Laikomi pririšti garduose"'><input type="radio" checked name="possesion" value="Laikomi pririšti garduose">Laikomi pririšti garduose</label>
                                    <label v-else><input type="radio" name="possesion" value="Laikomi pririšti garduose">Laikomi pririšti garduose</label>
                                </div>
                            </div>

                            <h4>Gyvulių skirstymas garduose</h4>

                            <div class="pot-box" v-for='animal in seller.animals'>
                                <h5 class="with-border">{{animal.animal_id}}</h5>
                                <div class="form-group">
                                    <div class="row animalPotRow">
                                        <div class="col-xs-3">
                                            <label v-if='seller["pot-"+animal.id] === "1"'><input type="radio" checked :name="'pot-'+animal.id" value="1">1 gardas</label>
                                            <label v-else><input type="radio" :name="'pot-'+animal.db_id" value="1">1 gardas</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <label v-if='seller["pot-"+animal.id] === "2"'><input type="radio" checked :name="'pot-'+animal.id" value="2">2 gardas</label>
                                            <label v-else><input type="radio" :name="'pot-'+animal.db_id" value="2">2 gardas</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <label v-if='seller["pot-"+animal.id] === "3"'><input type="radio" checked :name="'pot-'+animal.id" value="3">3 gardas</label>
                                            <label v-else><input type="radio" :name="'pot-'+animal.db_id" value="3">3 gardas</label>
                                        </div>
                                        <div class="col-xs-3">
                                            <label v-if='seller["pot-"+animal.id] === "4"'><input type="radio" checked :name="'pot-'+animal.id" value="4">4 gardas</label>
                                            <label v-else><input type="radio" :name="'pot-'+animal.db_id" value="4">4 gardas</label>
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
            var _ = this;

            this.getSeller();
        },

        data: function()
        {
            return {
                seller: {
                    pass_issued_date: '',
                    representative: '',
                    pvm_code: '',
                    pvm_rate: '',
                    post_code: '',
                    fooder: []
                }
            };
        },

        methods:
        {
            recalculateArriveDate: function()
            {
                var _ = this;

                Vue.set(_.seller, 'travel_start_date', $('.leaveDateInput').val());

                var arriveDate = new Date(_.seller.travel_start_date);
                var forwardTime = Number(_.seller.travel_start_hour) + Number(_.seller.travel_duration);
                arriveDate.setHours(forwardTime);
                arriveDate.setMinutes(_.seller.travel_start_minute);

                var arrivedd = arriveDate.getDate();
                var arrivemm = arriveDate.getMonth()+1;
                var arriveyyyy = arriveDate.getFullYear();
                let arrivehh= arriveDate.getHours();
                let arriveii = arriveDate.getMinutes();

                if(arrivedd<10) arrivedd = '0' + arrivedd;
                if(arrivemm<10) arrivemm = '0' + arrivemm;
                if(arrivehh<10) arrivehh = '0' + arrivehh;
                if(arriveii<10) arriveii = '0' + arriveii;

                var arriveFormated = arriveyyyy + "-" + arrivemm + "-" + arrivedd;

                _.seller.travel_arrive_date = arriveFormated;
                _.seller.travel_arrive_hour = arrivehh;
                _.seller.travel_arrive_minute = arriveii;
            },

            handleSameNameChange: function(e)
            {
                var _ = this;

                if($(e.target).is(':checked')) Vue.set(_.seller, 'representative',  $('.sellerNameInput').val());
                else _.seller.representative = '';
            },

            handleSameAddressChange: function(e)
            {
                var _ = this;

                if($(e.target).is(':checked')) _.seller.pick_up_address = $('.sellerAddressInput').val();
                else _.seller.pick_up_address = '';
            },

            getSeller: function()
            {
                var _ = this;
                var targetCode = getIdFromURL();

                offlineDB.find('sellers', targetCode, 'code').then((seller) => {
                    seller.animals = [];

                    offlineDB.get('animals', function(animalCursor)
                    {
                        if(animalCursor.value.seller_code == seller.code)
                        {
                            seller.animals.push(animalCursor.value);
                        }
                    }).then(() => {
                        if(typeof seller.pick_up_address == 'undefined') seller.pick_up_address = '';
                        if(!seller.post_code) seller.post_code = '';
                        if(!seller.pass_issued_date) seller.pass_issued_date = '';


                        let addMinutes = (date, minutes) => {
                            return new Date(date.getTime() + minutes*60000);
                        }

                        let in30Minutes = addMinutes(new Date(), 30);
                        let dd = in30Minutes.getDate();
                        let mm = in30Minutes.getMonth()+1;
                        let yyyy = in30Minutes.getFullYear();
                        let hh = in30Minutes.getHours();
                        let ii = in30Minutes.getMinutes();

                        if(dd<10) dd = '0' + dd;
                        if(mm<10) mm = '0' + mm;
                        if(hh<10) hh = '0' + hh;
                        if(ii<10) ii = '0' + ii;

                        seller.travel_start_date = yyyy+'-'+mm+'-'+dd;
                        seller.travel_start_hour = hh;
                        seller.travel_start_minute = ii;

                        seller.travel_duration = 1;

                        let in90Minutes = addMinutes(new Date(), 90);
                        dd = in90Minutes.getDate();
                        mm = in90Minutes.getMonth()+1;
                        yyyy = in90Minutes.getFullYear();
                        hh = in90Minutes.getHours();
                        ii = in90Minutes.getMinutes();

                        if(dd<10) dd = '0' + dd;
                        if(mm<10) mm = '0' + mm;
                        if(hh<10) hh = '0' + hh;
                        if(ii<10) ii = '0' + ii;

                        seller.travel_arrive_date = yyyy+'-'+mm+'-'+dd;
                        seller.travel_arrive_hour = hh;
                        seller.travel_arrive_minute = ii;

                        _.seller = seller;

                        if(!_.seller.fooder) _.seller.fooder = [];

                        if(_.seller.fooder.includes('Šienas'))        $(".sienas").prop('checked', true);
                        if(_.seller.fooder.includes('Šienainis'))     $(".sienainis").prop('checked', true);
                        if(_.seller.fooder.includes('Silosas'))       $(".silosas").prop('checked', true);
                        if(_.seller.fooder.includes('Šiaudai'))       $(".siaudai").prop('checked', true);
                        if(_.seller.fooder.includes('Koncentratai'))  $(".koncentratai").prop('checked', true);
                        if(_.seller.fooder.includes('Šakniavaisiai')) $(".sakniavaisiai").prop('checked', true);
                        if(_.seller.fooder.includes('Išspaudos'))     $(".isspaudos").prop('checked', true);
                        if(_.seller.fooder.includes('Kita'))          $(".kita").prop('checked', true);
                    });
                });
            },

            updateSeller: function()
            {
                var errors = [];
                var updatedSeller = {};
                var sellerForm = $(this.$refs.sellerForm);
                var sellerDataArr = sellerForm.serializeArray();
                var sellerFooder = [];
                var newAnimalPotPromises = [];

                for(var i = 0; i < sellerDataArr.length; i++)
                {
                    var sellerProperty = sellerDataArr[i];
                    updatedSeller[sellerProperty.name] = sellerProperty.value;

                    if(sellerProperty.name == 'fooder[]') sellerFooder.push(sellerProperty.value);
                }

                var newMergedSeller = Object.assign({}, this.seller, updatedSeller);
                newMergedSeller.code = getIdFromURL();
                newMergedSeller.fooder = sellerFooder;
                newMergedSeller.needUpdate = true;

                if(newMergedSeller.phone.length != 7) errors.push('Laukelis  mob. numeris privalo būti 7 skaitmenų ilgio!');
                if(!newMergedSeller.representative) errors.push('Laukelis pardavėjo atstovas yra privalomas!');
                if(!newMergedSeller.name) errors.push('Laukelis pardavėjo vardas yra privalomas!');
                if(!newMergedSeller.address) errors.push('Laukelis pardavėjo adresas yra privalomas!');
                if(!newMergedSeller.pick_up_address) errors.push('Laukelis laikymo adresas \\pakrovimo vieta yra privalomas!');
                if(!newMergedSeller.phone) errors.push('Laukelis mob. numeris yra privalomas!');

                if(errors.length > 0)
                {
                    var errorsDiv = $('<div class="alert alert-danger"><ul></ul></div>');

                    for(var g = 0; g < errors.length; g++)
                    {
                        errorsDiv.find('ul').append('<li>'+errors[g]+'</li>')
                    }

                    $(".formErrors").html(errorsDiv);

                    $('html,body').animate({
                       scrollTop: $(".formErrors").offset().top - 50
                    });
                }
                else
                {
                    offlineDB.update("sellers", newMergedSeller).then().then(() => {
                        offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
                            flags.sellersUpdate = true;

                            offlineDB.update('syncTableFlags', flags).then().then(() => {
                                formURL(sellerForm.attr('action'));
                            });
                        });
                    });
                }
            }
        }
    }
</script>
