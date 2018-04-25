<template>
    <div id='docContainer'>
        <div id='innerDocContainer'>
        	<table class="no-border">
        		<tr>
        			<td><strong>PARAIŠKA</strong></td>
        		</tr>
        		<tr>
        			<td class="text-left">UAB "Agaras"</td>
        		</tr>
        	</table>
        	<div class="row">
        		<div class="col-xs-12">
        			<strong>Gyvuliai pirkti</strong> <span class='doc_year'></span> m. <span class='doc_month'></span> mėn. <span class='doc_day'></span> d.
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-xs-12">
        			<strong>Supirkėjas</strong>
                    <span class='buyerNameField'></span>
        			<strong>Gyvuliai pristatyti iš</strong>
                    <span class='buyerAnimalsFromField'></span>
        			<strong>rajono</strong>
        			<span>Gyvuliai pristatyti į skerdyklą</span>
                    <span class='buyerAnimalsDeliverDate'></span>
        			<span>d.</span>
                    <span class='buyerAnimalsDeliverHour'></span>
        			<span>val.</span>
        		</div>
        	</div>
			<table class='hugeTable'>
                <thead>
    				<tr>
    					<td rowspan="2">Eil. Nr.</td>
    					<td rowspan="2">Agentai</td>
    					<td rowspan="2">Gyvulio ident. Nr.</td>
    					<td rowspan="2">Gyv. rūšis</td>
    					<td colspan="2">Važtaraštyje</td>
    					<td colspan="3">Skerdykloje</td>
    					<td rowspan="2" >Pastabos - kainininkas</td>
    				</tr>
    				<tr>
    					<td>Įmit. kateg.</td>
    					<td>Įskaitytas svoris, kg</td>
    					<td>Įmit. kateg.</td>
    					<td>Gyv. svoris, kg</td>
    					<td>Sv. skirtumas</td>
    				</tr>
                </thead>
                <tbody class='animalsTbody'></tbody>
                <tfoot>
                    <tr height="40px">
    					<td colspan="10">
    						<span class="table-footer">VISO: <span class='totalAnimals'></span></span>
    						<span class="table-footer">Iš jų buliai iki 24mėn.- <span class='youngBullCount'></span></span>
    						<span class="table-footer">virš 24mėn.- <span class='oldBullCount'></span></span>
    						<span class="table-footer">karvių - <span class='cowCount'></span></span>
    						<span class="table-footer">telyčių - <span class='heiferCount'></span></span>
    					</td>
    				</tr>
                </tfoot>
			</table>
    		<div class="col-xs-12 bottom">
    			Vairuotojas <strong class='driverName'></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    			Skerdyklos gyvulių priėmėjas...........................................................................
        	</div>
        </div>
    </div>
</template>

<script>
    import mixins from "../../mixins.js";

    export default {
        mounted: function()
        {
            var _ = this;

            _.getData();
        },

        data: function()
        {
            return {
                GETParams: {},
                docImgs: []
            };
        },

        methods:
        {
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

            getData: function()
            {
                var _ = this;
                _.GETParams = _.parseURLParams(window.location.href);

                if(_.GETParams.buyer_name[0]) $(".buyerNameField").text(_.GETParams.buyer_name[0]);
                else $(".buyerNameField").text('..............................');

                if(_.GETParams.buyer_animals_from[0]) $(".buyerAnimalsFromField").text(_.GETParams.buyer_animals_from[0]);
                else $(".buyerAnimalsFromField").text('............................');

                if(_.GETParams.buyer_animals_deliver_date[0]) $(".buyerAnimalsDeliverDate").text(_.GETParams.buyer_animals_deliver_date[0]);
                else $(".buyerAnimalsDeliverDate").text('........');

                if(_.GETParams.buyer_animals_deliver_hour[0]) $(".buyerAnimalsDeliverHour").text(_.GETParams.buyer_animals_deliver_hour[0]);
                else $(".buyerAnimalsDeliverHour").text('........');

                var animalNum = 1;
                var totalAnimals = 0;
                var youngBullCount = 0;
                var oldBullCount = 0;
                var cowCount = 0;
                var heiferCount = 0;

                var promises = [];

                _.GETParams.sellerCodes.map((item, i) => {
                    var currSellerCode = item;

                    offlineDB.find('sellers', Number(currSellerCode), 'code').then((sellerCursor) => {
                        var animalPromise = offlineDB.get('animals', (animalCursor) => {
                            if(animalCursor.value.seller_code == sellerCursor.code)
                            {
                                var index = i;
                                var currAgent = _.GETParams.agents[index];
                                var currAnimal = animalCursor.value;
                                var row = $("<tr>");
                                row.css("height", '40px');

                                let sexMapper = {
                                    'Bulius iki 24mėn.': 'A',
                                    'Bulius virš 24mėn': 'B',
                                    'Kastratas': 'C',
                                    'Karvė': 'D',
                                    'Telyčia': 'E',
                                    'Telyčaitė': 'E'
                                };

                                var animalCode = sexMapper[currAnimal.specie];
                                if(animalCode == 'A' && Number(currAnimal.age) >= 24) animalCode = "B";

                                row.append("<td>"+animalNum+"</td>");
                                row.append("<td>"+currAgent+"</td>");
                                row.append("<td class='nowrap'>"+animalCode+"-"+currAnimal.animal_id+"</td>");
                                row.append("<td>"+currAnimal.breed+"</td>");
                                row.append("<td>"+currAnimal.inclination+"</td>");
                                row.append("<td>"+currAnimal.includable_weight+"</td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td></td>");

                                animalNum++;
                                $(".animalsTbody").append(row);
                                totalAnimals++;

                                if((currAnimal.specie == 'Kastratas') && (Number(currAnimal.age) <= 24)) youngBullCount++;
                                else if((currAnimal.specie == 'Kastratas') && (Number(currAnimal.age) > 24)) oldBullCount++;

                                if(currAnimal.specie == 'Bulius iki 24mėn.') youngBullCount++;
                                if(currAnimal.specie == 'Bulius virš 24mėn') oldBullCount++;
                                if(currAnimal.specie == 'Karvė') cowCount++;
                                if((currAnimal.specie == 'Telyčia') || (currAnimal.specie == 'Telyčaitė')) heiferCount++;

                                $(".youngBullCount").text(youngBullCount);
                                $(".oldBullCount").text(oldBullCount);
                                $(".cowCount").text(cowCount);
                                $(".heiferCount").text(heiferCount);
                            }
                        });

                        promises.push(animalPromise);

                        if(i+1 == _.GETParams.sellerCodes.length)
                        {
                            Promise.all(promises).then(() => {
                                offlineDB.find('driver', 1, 'id').then((driverCursor) => {
                                    $(".driverName").text(driverCursor.name);
                                    $(".totalAnimals").text(totalAnimals);
                                   _.fillDocumentData();
                                   mixins.getTotalElementsToPrint(_);
                                   mixins.snapScreen(_);
                               });
                            });
                        }
                    });
                });
            },

            fillDocumentData: function()
            {
                var _ = this;
                var now = new Date();

                $(".doc_year").text(now.getFullYear());
                $(".doc_month").text(now.getMonth() + 1);
                $(".doc_day").text(now.getDate());
            }
        }
    }
</script>
