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
						<h3 class="box-title">Pridėti gyvulį</h3>
					</div>
					<form action="/o/animals" ref="animalForm" @submit.prevent="insertAnimal()">
                        <input type='hidden' name='animalFromServices' class='animalFromServices' value='0' />

						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio rūšies ID numeris</label>
									<input type="text" class="form-control animalIdInput" name="animal_id">
				                </div>
							</div>

                            <div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Bandos numeris</label>
									<input type="text" class="form-control herdNumberInput" name="herd_number" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Gyvulio paso numeris</label>
									<input type="text" class="form-control passportIdInput" name="passport_id">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class='form-group'>
									<label>Rūšis</label>

									<select class='form-control specieInput' name='specie' @change='updateDeviation($event)'>
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
									<select class="form-control breedInput" name="breed">
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
                                    <select class="form-control" name="cob">
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
									<input type="text" class="form-control datepicker animalAgeInput" data-date-end-date="" @blur='updateAnimalAge($event)' name="dob" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Įmitimo kategorija</label>
									<select class="form-control" name="inclination">
										<option value="-">Pasirinkti kategoriją</option>
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
									<input id="age" type="text" @change='correctBullSpecie' class="form-control ageInput" name="age" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Gyvasis svoris (kg)</label>
									<input type="number" class="form-control realWeightInput" name="real_weight" v-on:keyup="updateIncludableWeight" v-on:keydown="updateIncludableWeight()" @change="updateIncludableWeight()" step='0.001'>
				                </div>
							</div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Nuokrypis</label>
                                    <input type="number" class="form-control deviationInput" step='0.01' v-model='deviation' name='deviation' v-on:keyup="updateIncludableWeight()" v-on:keydown="updateIncludableWeight()" @change="updateIncludableWeight()">
                                </div>
                            </div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Įskaitomas svoris (kg)</label>
									<input type="number" class="form-control includableWeightInput" name="includable_weight" step='0.001'>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Užauginimo vieta</label>
                                    <select class="form-control" name="pog">
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
									<label >Eur/kg</label>
									<input type="number" class="form-control eurInput" name="price_kg" step='0.01' value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Vardas, pavardė arba įmonės pavadinimas</label>
									<input type="text" class="form-control sellerNameInput" name="seller_name" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Asmens / įmonės Kodas</label>
									<input type="number" class="form-control sellerCodeInput" name="code" value="">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Adresas</label>
									<input type="text" class="form-control sellerAddressInput" name="seller_address" value="">
				                </div>
							</div>
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">Sukurti</button>
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
            this.getFromServices();
        },

        data: function()
        {
            return {
                deviation: 5
            };
        },

        methods: {
            updateDeviation(event)
            {
                this.deviation = Number($(event.target).find(":selected").data('price-percentage'));
                this.updateIncludableWeight();
            },

            getFromServices: function()
            {
                var currURL = window.location.href;
                var GETData = this.parseURLParams(currURL);

                if(GETData)
                {
                    if(GETData.animal_id)
                    {
                        var targetId = GETData.animal_id[0];

                        let postData = {
                            animal_id: targetId
                        };

                        axios.get('/animals/create-by-id?animal_id='+targetId, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                }
                            }).then((response) => {
                                var responseData = response.data.data;
                                var animalData = responseData.animalData;

                                if(animalData.animal_id)
                                {
                                    if(animalData.sex == 'Karvė') this.deviation = 6;
                                    $(".animalFromServices").val('1');

                                    var animalBreedArr = [
                                        'Angusai',
                                        'Aubrakai',
                                        'Herefordai',
                                        'Juodmargiai x mėsinių veislių',
                                        'Lietuvos juodmargiai',
                                        'Žalieji x mėsinių veislių',
                                        'Lietuvos žalieji',
                                        'Limuzinai',
                                        'Mėsiniai x mėsinių veislių',
                                        'Simentalai',
                                        'Šarolė'
                                    ];

                                    if(jQuery.inArray(animalData.breed, animalBreedArr) === -1) animalData.breed = 'Kiti';

                                    if(animalData.sex == 'Buliukas') animalData.sex = 'Bulius iki 24mėn.';
                                    $('.breedInput').prop('disabled', true).val(animalData.breed);
                                    $(".animalIdInput").val(animalData.animal_id).prop('readonly', true);
                                    $(".sellerCodeInput").val(animalData.code).prop('readonly', true);
                                    $(".animalAgeInput").val(animalData.dob).prop('readonly', true);
                                    $(".herdNumberInput").val(animalData.herd_number).prop('readonly', true);
                                    $(".passportIdInput").val(animalData.passport_id).prop('readonly', true);
                                    $(".sellerAddressInput").val(animalData.seller_address).prop('readonly', true);
                                    $(".sellerNameInput").val(animalData.seller_name).prop('readonly', true);
                                    $(".animalIdInput").val(animalData.animal_id).prop('readonly', true);

                                    var monthDiff = (d1, d2) => {
                                        var months;
                                        months = (d2.getFullYear() - d1.getFullYear()) * 12;
                                        months -= d1.getMonth() + 1;
                                        months += d2.getMonth();
                                        return months <= 0 ? 0 : months;
                                    }

                                    var age =  monthDiff(new Date(animalData.dob), new Date());
                                    if(new Date().getDate() > new Date(animalData.dob).getDate()) age++;

                                    $(".ageInput").val(age);

                                    if((animalData.sex == 'Buliukas') && (age <= 24)) animalData.sex = 'Bulius iki 24mėn.';
                                    else if((animalData.sex == 'Buliukas') && (age > 24)) animalData.sex = 'Bulius virš 24mėn';

                                    if((age > 24) && (animalData.sex == 'Bulius iki 24mėn.')) animalData.sex = 'Bulius virš 24mėn';

                                    $('.specieInput').prop('disabled', true).val(animalData.sex);
                                }
                                else $(".formErrors").html('<div class="alert alert-danger">Gyvulys su duotu ID nerastas.</div>');
                            });
                    }
                }
            },

            parseURLParams: function(url)
            {
                var queryStart = url.indexOf("?") + 1,
                    queryEnd   = url.indexOf("#") + 1 || url.length + 1,
                    query = url.slice(queryStart, queryEnd - 1),
                    pairs = query.replace(/\+/g, " ").split("&"),
                    parms = {}, i, n, v, nv;

                if (query === url || query === "") return;

                for (i = 0; i < pairs.length; i++) {
                    nv = pairs[i].split("=", 2);
                    n = decodeURIComponent(nv[0]);
                    v = decodeURIComponent(nv[1]);

                    if (!parms.hasOwnProperty(n)) parms[n] = [];
                    parms[n].push(nv.length === 2 ? v : null);
                }
                return parms;
            },

            updateIncludableWeight: function()
            {
                var _ = this;

                let deviationMultiplier = 1 - (this.deviation / 100);

                $(".includableWeightInput").val(Math.round(Number($(".realWeightInput").val()) * deviationMultiplier));
            },

            correctBullSpecie: function()
            {
                console.log("G");
                // $(".speciaInput").val(animalData.sex).prop('readonly', true);
            },

            updateAnimalAge: function(event)
            {
                // setTimeout(() => {
                //
                // }, 100);
            },

            insertAnimal: function()
            {
                var errors = [];
                var newAnimal = {};
                var newSeller = {};
                var animalsForm = $(this.$refs.animalForm);
                var animalDataArr = animalsForm.serializeArray();

                for(var i = 0; i < animalDataArr.length; i++)
                {
                    var animalProperty = animalDataArr[i];
                    newAnimal[animalProperty.name] = animalProperty.value;
                }

                newSeller.code = Number(newAnimal.code);
                newSeller.address = newAnimal.seller_address;
                newSeller.name = newAnimal.seller_name;
                newSeller.date_created = Math.floor(Date.now());

                newAnimal.seller_code = Number(newSeller.code);
                newAnimal.date_created = Math.floor(Date.now());
                newAnimal.deviation = Number(newAnimal.deviation);

                newAnimal.needSync = true;
                newSeller.needSync = false;
                newAnimal.needUpdate = false;
                newSeller.needUpdate = false;

                delete newAnimal.code;
                delete newAnimal.seller_address;
                delete newAnimal.seller_name;

                if(!newAnimal.herd_number) errors.push('Laukelis gyvulio bandos numeris yra privalomas!');
                if(!newAnimal.animal_id) errors.push('Laukelis gyvulio rūšies ID numeris yra privalomas!');
                if(!newAnimal.age) errors.push('Laukelis gyvulio amžius yra privalomas!');
                if(!newAnimal.dob) errors.push('Laukelis gimimo data yra privalomas!');
                if(!newAnimal.cob) errors.push('Laukelis gimimo šalis yra privalomas!');
                if(!newAnimal.pog) errors.push('Laukelis užauginimo vieta yra privalomas!');
                if(!newAnimal.inclination) errors.push('Pasirinkite įmitimo kategoriją');
                if(!newAnimal.real_weight) errors.push('Laukelis gyvasis svoris yra privalomas!');
                if(!newAnimal.includable_weight) errors.push('Laukelis įskaitomas svoris yra privalomas!');
                if(newAnimal.inclination == '-') errors.push('Laukekis įmitimo kategorija yra privalomas!');
                if((newAnimal.inclination != "-") && (newAnimal.inclination != "0") && (!newAnimal.price_kg)) errors.push('Jeigu įmitimo kategorija nėra ,,Pagal skerdieną", privaloma įvesti kainą!');
                if(!newSeller.name) errors.push('Laukelis vardas, pavardė arba įmonės pavadinimas yra privalomas!');
                if(!newSeller.address) errors.push('Laukelis addresas yra privalomas!');
                if(!newSeller.code) errors.push('Laukelis asmens/įmonės kodas yra privalomas!');

                newSeller.code = newSeller.code + '';

                if((newSeller.code) && ((newSeller.code.length != 9 ) && (newSeller.code.length != 11))) errors.push('Laukelis asmens/įmonės kodas privalo būti 9 arba 11 skaičių ilgio');

                newSeller.code = Number(newSeller.code);

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
                    newAnimal.breed = $(".breedInput").val();
                    newAnimal.specie = $(".specieInput").val();
                    newAnimal.price_kg = newAnimal.price_kg.replace(/,/g, ".");

                    let sexMapper = {
                        'Bulius iki 24mėn.': 'A',
                        'Bulius virš 24mėn': 'B',
                        'Kastratas': 'C',
                        'Karvė': 'D',
                        'Telyčia': 'E',
                        'Telyčaitė': 'E'
                    };

                    if((newAnimal.specie == 'Bulius iki 24mėn.') && (Number(newAnimal.age) > 24)) newAnimal.specie = 'Bulius virš 24mėn';

                    offlineDB.find('sellers', Number(newAnimal.seller_code), 'code').then((seller) => {
                        offlineDB.insert("animals", newAnimal).then().then(() => {
                            offlineDB.update("sellers", newSeller).then(() => {
                                offlineDB.find('syncTableFlags', 1, 'id').then((flags) => {
                                    flags.animalsInsert = true;

                                    offlineDB.update('syncTableFlags', flags).then(() => {
                                        formURL(animalsForm.attr('action'));
                                    });
                                });
                            });
                        });
                    });
                }
            }
        }
    }
</script>
