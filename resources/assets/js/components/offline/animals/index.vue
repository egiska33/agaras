<template>
    <div>
        <div class="container spark-screen">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="box">
    					<div class="box-header with-border">
    						<h3 class="box-title"><i class="fa fa-github-alt" aria-hidden="true"></i> Gyvuliai</h3>
    					</div>
    					<div class="box-body">
    		                <div class="dataTables_wrapper form-inline dt-bootstrap">
    					        <div class="row">
        					    	<div class="col-xs-12 col-sm-5 col-md-6">
        						    	<a href="/o/animals/create-by-id" style='display:none' class="btn btn-primary btn-sm margin-bottom addAnimalById"><i class='fa fa-plus'></i> Pridėti naują pagal ID</a>
        						    	<a href="/o/animals/create" class="btn btn-primary btn-sm margin-bottom"><i class='fa fa-plus'></i> Pridėti naują</a>
        					    	</div>

                                    <div class="search-block col-xs-12 col-sm-7 col-md-6 text-right">
    					                <label>Ieškoti:
    						                <input name="search" type="text" v-model='searchText' @keyup='toggleCleanBtn($event)' @keypress='toggleCleanBtn($event)' @keydown='toggleCleanBtn($event)' class="form-control input-sm" value="" />
    					                </label>
    					                <button type="submit" class="btn btn-primary btn-sm animalSearchInput" @click='searchAnimals()' >Ieškoti</button>
    					                <a href="/o/animals" style='display: none' class="btn btn-danger btn-sm cleanSearchBtn">Išvalyti</a>
        					        </div>
        					    </div>
        					    <div class="row">
        					        <div class="col-sm-12">
        					            <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
        					                <thead>
        					                    <tr role="row">
        					                        <th>ID Nr.</th>
        					                        <th>Paso Nr.</th>
        					                        <th>Rūšis</th>
        					                        <th>Veislė</th>
        					                        <th>Gimimo data</th>
        					                        <th>Gimimo šalis</th>
        					                        <th>Įmitimas</th>
        					                        <th>Gyvas svoris</th>
        					                        <th>Įskait. svoris</th>
        					                        <th>EUR/kg</th>
        					                        <th>Pardavėjas</th>
        					                        <th>Veiksmai</th>
        					                    </tr>
        					                </thead>
        					                <tbody>
                                                <tr v-for='animal in animals'>
                                                    <td v-if='animal.animal_id'>{{ animal.animal_id }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.passport_id'>{{ animal.passport_id }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.specie'>{{ animal.specie }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.breed'>{{ animal.breed }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.dob'>{{ animal.dob }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.cob'>{{ animal.cob }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.inclination'>{{ animal.inclination }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.real_weight'>{{ animal.real_weight }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.includable_weight'>{{ animal.includable_weight }}</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.price_kg'>{{ animal.price_kg }} €</td><td v-else class='hidden-sm'></td>
    						                		<td v-if='animal.seller.name'>{{ animal.seller.name }}</td><td v-else class='hidden-sm'></td>
    						                		<td>
    						                			<a :href="'/o/animals/edit/'+animal.id" class="btn btn-sm btn-primary">Redaguoti</a>
    						                			<a href='' class="btn btn-sm btn-danger button-delete" v-on:click.prevent="triggerDeleteAnimalConfirm($event)" :data-delete-id='animal.id'>Ištrinti</a>
    						                		</td>
                                                </tr>
        					                </tbody>
        					            </table>
        					        </div>
        					    </div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted: function()
        {
            this.getAnimals();

            if(navigator.onLine) $(".addAnimalById").show();
        },

        data: function()
        {
            return {
                animals: [],
                deleteAnimalId: undefined,
                searchText: ''
            };
        },

        methods:
        {
            searchAnimals: function()
            {
                var searchText = $(".animalSearchInput").val();

                var DBAnimals = [];

                offlineDB.get('animals', function(animalCursor)
                {
                    DBAnimals.push(animalCursor.value);
                }).then(() => {

                    var found = false;
                    this.animals = [];
                    var searchProps = [
                        'animal_id',
                        'passport_id',
                        'cob',
                        'inclination',
                        'real_weight',
                        'includable_weight',
                        'pog'
                    ];


                    for(let m = 0; m < searchProps.length; m++)
                    {
                        let currProp = searchProps[m];

                        for(let g = 0; g < DBAnimals.length; g++)
                        {
                            let currentAnimal = DBAnimals[g];

                            if(currentAnimal[currProp].includes(this.searchText))
                            {
                                offlineDB.find('sellers', Number(currentAnimal.seller_code), 'code').then((seller) => {
                                    currentAnimal.seller = seller;
                                    this.animals.push(currentAnimal);
                                });
                                found = true;
                            }
                        }

                        if(found) break;
                    }
                });
            },

            toggleCleanBtn: function(e)
            {
                if($(e.target).val().length > 0) $(".cleanSearchBtn").show();
                else $(".cleanSearchBtn").hide();
            },

            triggerDeleteAnimalConfirm: function(event)
            {
                this.$data.deleteAnimalId = $(event.target).data('delete-id');
                if(confirm("Ar tikrai norite ištrinti pasirinktą gyvulį?")) this.deleteAnimal();
            },

            deleteAnimal: function()
            {
                offlineDB.delete('animals', this.$data.deleteAnimalId, 'id');

                location.reload();
            },

            getAnimals: function()
            {
                var _ = this;

                offlineDB.get('animals', function(cursor)
                {
                    var currentAnimal = cursor.value;
                    offlineDB.find('sellers', Number(cursor.value.seller_code), 'code').then((seller) => {
                        currentAnimal.seller = seller;

                        if(!currentAnimal.passport_id) currentAnimal.passport_id = '-';

                        _.animals.push(currentAnimal);
                    });
                }).then(() => {
                    _.animals.sort(function(a,b) {
                        return (a.date_created > b.date_created) ? -1 : ((b.date_created > a.date_created) ? 1 : 0);
                    });
                });
            }
        }
    }
</script>
