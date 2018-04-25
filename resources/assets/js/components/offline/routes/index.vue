<template>
    <div>
        <div class="container spark-screen">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-globe" aria-hidden="true"></i> {{ driver.name }} ({{ driver.plate }}) Maršrutai</h3>
                        </div>
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered dataTable table-striped table-responsive-row routesTable" role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th>Išvykimo data</th>
                                                    <th>Pavadinimas</th>
                                                    <th>Adresas</th>
                                                    <th>Mob. nr.</th>
                                                    <th>Galvijų sk.</th>
                                                    <th>Byla</th>
                                                    <th>Komentaras</th>
                                                    <!-- <th>Veiksmai</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='route in routes' role='row'>
                                                    <td v-if='route.formattedDate'>{{ route.formattedDate }}</td><td v-else>-</td>
                                                    <td v-if='route.name'>{{ route.name }}</td><td v-else>-</td>
                                                    <td v-if='route.seller_address'>{{ route.seller_address }}</td><td v-else>-</td>
                                                    <td v-if='route.phone'>{{ route.phone }}</td><td v-else>-</td>
                                                    <td v-if='route.total_animals'>{{ route.total_animals }}</td><td v-else>-</td>
                                                    <td v-if='route.file'>
                                                        <a :href='"/uploads/"+route.file.filename' target='_blank' >{{ route.file.filename }}</a>
                                                    </td><td v-else></td>
                                                    <td v-if='route.comment'>{{ route.comment }}</td><td v-else>-</td>
                                                    <!-- <td>
                                                        <a href="#" class="toggle-modal" :data-id="route.id" data-toggle="modal" data-target="#modal-default">Pridėti komentarą</a>
                                                    </td> -->
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Žemėlapis</h3>
                            </div>
                            <ul>
                                <li v-for='err in markerErrors'>Pardavėjo adresu <b>{{ err }}</b> vietos nepavyko nustatyti.</li>
                            </ul>
                            <div class="box-body">
                                <gmap-map
                                    :center="{lat:55.108803, lng:24.119208}"
                                    :zoom="8"
                                    map-type-id="terrain"
                                    style="display:none; width: 100%; height: 800px;"
                                    id='DriverMap'>
                                    <gmap-marker
                                        :key="index"
                                        v-for="(m, index) in mapMarkers"
                                        :position="m.position">
                                    </gmap-marker>
                                </gmap-map>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade in" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Pridėti komentarą</h4>
                    </div>
                    <form action="" method="POST">
                        <input id="row-id" type="hidden" name="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Komentaras</label>
                                <textarea class="form-control textarea" rows="3" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Uždaryti</button>
                            <button type="submit" class="btn btn-primary">Išsaugoti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import * as VueGoogleMaps from 'vue2-google-maps';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyBCEnBFUYhcQ8Ntint6QIGLmafq9FavCwQ',
            libraries: 'places'
        }
    })

    export default {
        mounted: function()
        {
            if(navigator.onLine) $("#DriverMap").show();

            this.getDriver();
            this.getRoutes();
        },

        data: function()
        {
            return {
                routes: [],
                driver: {},
                mapMarkers: [],
                markerErrors: []
            };
        },

        methods:
        {
            parseMarkersToMap: function()
            {
                var _ = this;
    			$.each( this.driver.markers, function( index, value ){
    				$.get("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBCEnBFUYhcQ8Ntint6QIGLmafq9FavCwQ&address='"+value+"'",function(data) {
                        if(data.status == 'ZERO_RESULTS') _.markerErrors.push(value);
                        else
                        {
                            _.mapMarkers.push({
                                position: {
                                    lat: data.results[0].geometry.location.lat,
              				        lng: data.results[0].geometry.location.lng,
                                }
                            });
                        }
    				});
    			});
            },

            getDriver: function()
            {
                var _ = this;

                offlineDB.find('driver', 1, 'id').then((driver) => {
                    _.driver = driver;

                    this.parseMarkersToMap();
                });
            },

            getRoutes: function()
            {
                var _ = this;

                offlineDB.get('routes', function(routeCursor)
                {
                    var route = routeCursor.value;

                    route.formattedDate = route.pick_up_time.substring(0, route.pick_up_time.indexOf(' '));

                    if(!route.file) route.file = {
                        filename: '-'
                    }

                    _.routes.push(route);
                }).then(() => {
                    _.routes.sort(function(a,b) {
                        return (a.id > b.id) ? -1 : ((b.id > a.id) ? 1 : 0);
                    });
                });
            },
        }
    }
</script>
