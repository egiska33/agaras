<template>
    <div class="container spark-screen">
        <div class='row'>
            <div class="col-xs-12 col-md-8 col-md-offset-2 formErrors">

            </div>
        </div>
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Redaguoti gyvulį</h3>
					</div>
					<form action="/o/animals" ref="animalForm" @submit.prevent="updateAnimal()">
                        <input type='hidden' name='animalFromServices' class='animalFromServices' v-model='animal.animalFromServices' />
						<input type="hidden" class='sellerCodeInput' name="seller_code" value="">
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio rūšies ID numeris</label>
									<input type="text" class="form-control animalIdInput" name='animal_id' :value="animal.animal_id">
				                </div>
							</div>

                            <div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Bandos numeris</label>
									<input type="text" class="form-control herdNumberInput" name="herd_number" :value="animal.herd_number">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio paso numeris</label>
									<input type="text" class="form-control passportIdInput" name='passport_id' :value="animal.passport_id">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
								   <label>Rūšis</label>
                                   <select class='form-control specieInput' v-model='animal.specie' name='specie' @change='updateDeviation($event)'>
                                       <option data-price-percentage='5' value="Bulius iki 24mėn.">Bulius iki 24mėn.</option>
                                       <option data-price-percentage='5' value="Bulius virš 24mėn">Bulius virš 24mėn</option>
                                       <option data-price-percentage='5' value="Kastratas">Kastratas</option>
                                       <option data-price-percentage='6' value="Karvė">Karvė</option>
                                       <option data-price-percentage='5' value="Telyčia">Telyčia</option>
                                       <option data-price-percentage='5' value="Telyčaitė">Telyčaitė</option>
                                   </select>
							   </div>
						   </div>

						   <div class="col-xs-12 col-md-6">
							   <div class="form-group">
								   <label>Veislė</label>
								   <select v-model='animal.breed' class="form-control breedInput" name='breed'>
                                       <option value="Kiti">Kiti</option>
                                       <option value="Angusai">Angusai</option>
                                       <option value="Aubrakai">Aubrakai</option>
                                       <option value="Herefordai">Herefordai</option>
                                       <option value="Juodmargiai x mėsinių veislių">Lietuvos juodmargiai x mėsiniai</option>
                                       <option value="Lietuvos juodmargiai">Lietuvos juodmargiai</option>
                                       <option value="Žalieji x mėsinių veislių">Lietuvos žalieji x mėsiniai</option>
                                       <option value="Lietuvos žalieji">Lietuvos žalieji</option>
                                       <option value="Limuzinai">Limuzinai</option>
                                       <option value="Mėsiniai x mėsinių veislių">Mėsiniai x mėsiniai</option>
                                       <option value="Simentalai">Simentalai</option>
                                       <option value="Šarolė">Šarolė</option>
								   </select>
							   </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gimimo šalis</label>
									<select v-model='animal.cob' class="form-control" name="cob">
										<option value="Lietuva">Lietuva</option>
										<option value="Airija">Airija</option>
										<option value="Austrija">Austrija</option>
										<option value="Belgija">Belgija</option>
										<option value="Bulgarija">Bulgarija</option>
										<option value="Čekija">Čekija</option>
										<option value="Danija">Danija</option>
										<option value="Estija">Estija</option>
										<option value="Graikija">Graikija</option>
										<option value="Ispanija">Ispanija</option>
										<option value="Italija">Italija</option>
										<option value="Jungtinė Karalystė">Jungtinė Karalystė</option>
										<option value="Kipras">Kipras</option>
										<option value="Kroatija">Kroatija</option>
										<option value="Latvija">Latvija</option>
										<option value="Lenkija">Lenkija</option>
										<option value="Liuksemburgas">Liuksemburgas</option>
										<option value="Malta">Malta</option>
										<option value="Nyderlandai">Nyderlandai</option>
										<option value="Portugalija">Portugalija</option>
										<option value="Prancūzija">Prancūzija</option>
										<option value="Rumunija">Rumunija</option>
										<option value="Slovakija">Slovakija</option>
										<option value="Slovėnija">Slovėnija</option>
										<option value="Suomija">Suomija</option>
										<option value="Švedija">Švedija</option>
										<option value="Vengrija">Vengrija</option>
										<option value="Vokietija">Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gimimo data</label>
									<input type="text" name='dob' class="form-control datepicker animalAgeInput" :value="animal.dob">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Įmitimo kategorija</label>
									<select v-model='animal.inclination' class="form-control" name="inclination">
										<option value="-">-</option>
										<option value="0">Pagal skerdieną</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Amžius (mėn.)</label>
									<input type="text" name='age' id='age' class="form-control" v-model="animal.age">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gyvasis svoris (kg)</label>
									<input type="number" class="form-control" name="real_weight" step='0.001' v-on:keyup="updateIncludableWeight" v-on:keydown="updateIncludableWeight()" @change="updateIncludableWeight()" v-model='animal.real_weight'>
				                </div>
							</div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Nuokrypis</label>
                                    <input type="number" class="form-control deviationInput" step='0.01' v-model='animal.deviation' v-on:keyup="updateIncludableWeight()" v-on:keydown="updateIncludableWeight()" @change="updateIncludableWeight()">
                                </div>
                            </div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Įskaitomas svoris (kg)</label>
									<input type="number" class="form-control" name="includable_weight" step='0.001' v-model="animal.includable_weight">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Užauginimo vieta</label>
									<select v-model='animal.pog' class="form-control" name="pog">
										<option value="Lietuva">Lietuva</option>
										<option value="Airija">Airija</option>
										<option value="Austrija">Austrija</option>
										<option value="Belgija">Belgija</option>
										<option value="Bulgarija">Bulgarija</option>
										<option value="Čekija">Čekija</option>
										<option value="Danija">Danija</option>
										<option value="Estija">Estija</option>
										<option value="Graikija">Graikija</option>
										<option value="Ispanija">Ispanija</option>
										<option value="Italija">Italija</option>
										<option value="Jungtinė Karalystė">Jungtinė Karalystė</option>
										<option value="Kipras">Kipras</option>
										<option value="Kroatija">Kroatija</option>
										<option value="Latvija">Latvija</option>
										<option value="Lenkija">Lenkija</option>
										<option value="Liuksemburgas">Liuksemburgas</option>
										<option value="Malta">Malta</option>
										<option value="Nyderlandai">Nyderlandai</option>
										<option value="Portugalija">Portugalija</option>
										<option value="Prancūzija">Prancūzija</option>
										<option value="Rumunija">Rumunija</option>
										<option value="Slovakija">Slovakija</option>
										<option value="Slovėnija">Slovėnija</option>
										<option value="Suomija">Suomija</option>
										<option value="Švedija">Švedija</option>
										<option value="Vengrija">Vengrija</option>
										<option value="Vokietija">Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Eur/kg</label>
									<input type="number" class="form-control" step='0.01' name="price_kg" v-model="animal.price_kg">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Vardas, pavardė arba įmonės pavadinimas</label>
									<input type="text" disabled class="form-control" :value="animal.seller.name">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Asmens / įmonės Kodas</label>
									<input type="text" disabled class="form-control" :value="animal.seller.code">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Adresas</label>
									<input type="text" disabled class="form-control" :value="animal.seller.address">
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
            this.getAnimal();
        },

        data: function()
        {
            return {
                animal: {
                    seller: {}
                }
            };
        },

        methods:
        {
            updateDeviation(event)
            {
                this.animal.deviation = Number($(event.target).find(":selected").data('price-percentage'));
                this.updateIncludableWeight();
            },

            getAnimal: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                offlineDB.find('animals', targetId, 'id').then((animal) => {
                    offlineDB.find('sellers', Number(animal.seller_code), 'code').then((seller) => {
                        animal.seller = seller;
                        _.animal = animal;

                        if(_.animal.animalFromServices == '1')
                        {
                            $(".animalFromServices").val('1');

                            $('.breedInput').prop('disabled', true);
                            $('.specieInput').prop('disabled', true);
                            $(".animalIdInput").prop('readonly', true);
                            $(".animalAgeInput").prop('readonly', true);
                            $(".herdNumberInput").prop('readonly', true);
                            $(".passportIdInput").prop('readonly', true);
                        }

                        $(".sellerCodeInput").val(animal.seller.code);

                        _.animal.includable_weight = Math.round(Number(_.animal.real_weight) * 0.96);
                    });
                });
            },

            updateIncludableWeight: function()
            {
                var _ = this;

                let deviationMultiplier = 1 - (_.animal.deviation / 100);

                _.animal.includable_weight = Math.round(Number(_.animal.real_weight) * deviationMultiplier);
            },

            updateAnimal: function()
            {
                var errors = [];
                var updatedAnimal = {};
                var animalsForm = $(this.$refs.animalForm);
                var animalDataArr = animalsForm.serializeArray();

                for(var i = 0; i < animalDataArr.length; i++)
                {
                    var animalProperty = animalDataArr[i];
                    updatedAnimal[animalProperty.name] = animalProperty.value;
                }

                var newMergedAnimal = Object.assign({}, this.animal, updatedAnimal);
                delete newMergedAnimal.seller;

                newMergedAnimal.seller_code = Number(newMergedAnimal.seller_code);
                newMergedAnimal.needUpdate = true;

                if(!newMergedAnimal.herd_number) errors.push('Laukelis gyvulio bandos numeris yra privalomas!');
                if(!newMergedAnimal.animal_id) errors.push('Laukelis gyvulio rūšies ID numeris yra privalomas!');
                if(!newMergedAnimal.age) errors.push('Laukelis gyvulio amžius yra privalomas!');
                if(!newMergedAnimal.dob) errors.push('Laukelis gimimo data yra privalomas!');
                if(!newMergedAnimal.cob) errors.push('Laukelis gimimo šalis yra privalomas!');
                if(!newMergedAnimal.pog) errors.push('Laukelis užauginimo vieta yra privalomas!');
                if(!newMergedAnimal.inclination) errors.push('Pasirinkite įmitimo kategoriją');
                if(!newMergedAnimal.real_weight) errors.push('Laukelis gyvasis svoris yra privalomas!');
                if(!newMergedAnimal.includable_weight) errors.push('Laukelis įskaitomas svoris yra privalomas!');
                if(newMergedAnimal.inclination == '-') errors.push('Laukekis įmitimo kategorija yra privalomas!');
                if((newMergedAnimal.inclination != "-") && (newMergedAnimal.inclination != "0") && (!newMergedAnimal.price_kg)) errors.push('Jeigu įmitimo kategorija nėra ,,Pagal skerdieną", privaloma įvesti kainą!');

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
                    newMergedAnimal.price_kg = newMergedAnimal.price_kg.replace(/,/g, ".");
                    if((newMergedAnimal.specie == 'Bulius iki 24mėn.') && (Number(newMergedAnimal.age) > 24)) newMergedAnimal.specie = 'Bulius virš 24mėn';

                    offlineDB.update("animals", newMergedAnimal).then().then(() => {
                        offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
                            flags.animalsUpdate = true;

                            offlineDB.update('syncTableFlags', flags).then().then(() => {
                                formURL(animalsForm.attr('action'));
                            });
                        });
                    });
                }
            }
        }
    }
</script>
