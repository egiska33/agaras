<template>
    <div>
        <div class="container spark-screen">
    		<div class="row">
    			<div class="col-md-12">
    				<div class="box">
    					<div class="box-header with-border">
    						<h3 class="box-title"><i class="fa fa-handshake-o" aria-hidden="true"></i> Pardavėjai</h3>
    					</div>
    					<div class="box-body">
    		                <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class='row'>
                                    <div class="search-block col-xs-12 text-right">
    					                <label>Ieškoti:
    						                <input name="search" type="text" @keyup='toggleCleanBtn($event)' @keypress='toggleCleanBtn($event)' @keydown='toggleCleanBtn($event)' class="form-control input-sm" v-model='searchText' />
    					                </label>
    					                <button type="submit" class="btn btn-primary btn-sm sellersSearchInput" @click='searchSellers()'>Ieškoti</button>
    					                <a href="/o/sellers" style='display: none' class="btn btn-danger btn-sm cleanSearchBtn">Išvalyti</a>
        					        </div>
                                </div>
    					        <div class="row">
    					            <div class="col-sm-12">
    					                <table class="table table-bordered table-striped table-responsive-row" role="grid">
    					                    <thead class="hidden-xs">
    					                        <tr role="row">
    					                            <th>Pavadinimas</th>
    					                            <th>Kodas</th>
    					                            <th>Adresas</th>
    					                            <th>PVM kodas</th>
    					                            <th>Mob. nr.</th>
    					                            <th>PVM tarifas</th>
    					                            <th>Paimti gyv.</th>
    					                            <th>Veiksmai</th>
    					                        </tr>
    					                    </thead>
    					                    <tbody>
                                                <tr v-for='seller in sellers'>
                                                    <td v-if='seller.name'>{{ seller.name }}</td><td v-else></td>
    						                		<td v-if='seller.code'>{{ seller.code }}</td><td v-else></td>
    						                		<td v-if='seller.address'>{{ seller.address }}</td><td v-else></td>
    						                		<td>{{ seller.pvm_code }}</td>
    						                		<td v-if='seller.phone'>{{ seller.phone }}</td><td v-else></td>
    						                		<td v-if='!seller.pvm_code'>0</td><td v-else-if='seller.pvm_rate'>{{ seller.pvm_rate }}</td><td v-else>0</td>
    						                		<td v-if='seller.animalCount'>{{ seller.animalCount }}</td><td v-else>0</td>
    						                		<td>
    						                			<a :href="'/o/sellers/edit/'+seller.code" class="btn btn-sm btn-primary">Redaguoti</a>
    						                			<a href='' class="btn btn-sm btn-danger button-delete" v-on:click.prevent="triggerDeleteSellerConfirm($event)" :data-delete-code='seller.code'>Ištrinti</a>
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
            this.getSellers();
        },

        data: function()
        {
            return {
                sellers: [],
                deleteSellerId: undefined,
                searchText: ''
            };
        },

        methods:
        {
            searchSellers: function()
            {
                var searchText = $(".sellersSearchInput").val();

                var DBSellers = [];

                offlineDB.get('sellers', function(sellerCursor)
                {
                    DBSellers.push(sellerCursor.value);
                }).then(() => {
                    var found = false;
                    this.sellers = [];
                    var searchProps = [
                        'name',
                        'code',
                        'address',
                        'phone'
                    ];

                    for(let m = 0; m < searchProps.length; m++)
                    {
                        let currProp = searchProps[m];

                        for(let g = 0; g < DBSellers.length; g++)
                        {
                            let currentSeller = DBSellers[g];

                            currentSeller[currProp] = currentSeller[currProp] + '';

                            if(currentSeller[currProp].includes(this.searchText))
                            {
                                this.sellers.push(currentSeller);
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

            triggerDeleteSellerConfirm: function(event)
            {
                var deleteConfirm = confirm("Ar tikrai norite ištrinti pasirinktą pardavėją ir visus jo sukurtus gyvulius?");
                if(deleteConfirm) this.deleteSeller($(event.target).data('delete-code'));
            },

            deleteSeller: function(targetDeleteCode)
            {
                offlineDB.deleteWhere('animals', targetDeleteCode, 'seller_code');
                offlineDB.delete('sellers', targetDeleteCode, 'code');

                location.reload();
            },

            getSellers: function()
            {
                var _ = this;

                offlineDB.get('sellers', function(cursor)
                {
                    var currentSeller = cursor.value;
                    currentSeller.animalCount = 0;

                    if(!currentSeller.phone) currentSeller.phone = '-';
                    else currentSeller.phone = '+3706'+currentSeller.phone;

                    offlineDB.count('animals', Number(currentSeller.code), 'seller_code').then((animalCount) => {
                        currentSeller.animalCount = animalCount;

                        if(!currentSeller.pvm_code) currentSeller.pvm_code = 'ne PVM mokėtojas';

                        _.sellers.push(currentSeller);
                    });
                }).then(() => {
                    _.sellers.sort(function(a,b) {
                        return (a.date_created > b.date_created) ? -1 : ((b.date_created > a.date_created) ? 1 : 0);
                    });
                });;
            }
        }
    }
</script>
