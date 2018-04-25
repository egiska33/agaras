<template>
    <div id='docContainer'>
        <div id='innerDocContainer'>
            <table class="no-border">
        		<tr height="50px">
        			<td><h1>KROVINIO VAŽTARAŠTIS</h1></td>
        		</tr>
        		<tr height="20px">
        			<td><strong>Serija </strong><span class='kvSeries'></span> Nr. </strong><span class='kvNo'></span></td>
        		</tr>
        		<tr height="30px">
        			<td><span class='doc_year'></span> m. <span class='doc_month'></span> mėn. <span class='doc_day'></span> d.</td>
        		</tr>
        		<tr>
        			<td class="text-left font-8">
        				Krovinio gavėjas: UAB &quot;Agaras&quot;, Agaro g. 5, Balandiškių k. Pabiržės sen., Biržų r. LT-41385, Lietuva.
        			</td>
        		</tr>
        		<tr>
        			<td class="text-left font-8">Tel. (8-450) 43111, (8-450) 59339, faks. (8-450) 43112 Įmonės kodas 154742821 PVM mokėtojo kodas LT547428219</td>
        		</tr>
        	</table>
        	<table class="no-border no-collapse table-text-left margin-10">
        		<tr>
        			<td>Pardavėjas</td>
        			<td class="solid-line field_1" width="91%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(juridinio asmens pavadinimas arba fizinio asmens vardas, pavardė, adresas, tel., faks., el. pašto adresas)</td>
        		</tr>
        		<tr height="20px">
        			<td class="solid-line" colspan="2"></td>
        		</tr>
        	</table>
        	<p>
        		Gyvuliai priimti pagal gyvulių važtaraštį (kitą dokumentą) Serija <span class='ppSeries'></span> Nr. <span class='ppNo'></span>
        	</p>
        	<p>
        		Pakrovimo data ir laikas: <span class='field_2'></span>
        	</p>
        	<table class="no-border no-collapse table-text-left">
        		<tr>
        			<td>Pakrovimo vieta</td>
        			<td class="solid-line field_3" width="88%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(tikslus krovinio pakrovimo vietos adresas)</td>
        		</tr>
        	</table>
        	<p class='field_4'>

        	</p>
        	<p>
        		Gyvulių vežėjo veterinarinio patvirtinimo Nr. 36-09. Kelionės lapo Nr. <span class='field_5'></span>
        	</p>
        	<table class="no-border no-collapse table-text-left">
        		<tr>
        			<td>Krovinio iškrovimo vieta: Balandiškių km., Pabiržės sen., Biržų raj.</td>
        			<td class="solid-line field_6" width="55%"></td>
        		</tr>
        		<tr>
        			<td></td>
        			<td class="text-center text-below">(iškrovimo data ir laikas)</td>
        		</tr>
        	</table>
        	<table class="no-outer-border margin-10 hugeTable">
                <thead>
            		<tr>
            			<td>Gyvulio rūšis ir identifikavimo nr.</td>
            			<td>Gyvulio paso serija ir Nr.</td>
            			<td>Lytis</td>
            			<td>Amžius mėn.</td>
            			<td>Galvų skaičius</td>
            			<td>Gyvas svoris, kg</td>
            			<td>Įskaitinis svoris, kg</td>
            		</tr>
                </thead>
                <tbody class='animalsTbody'></tbody>
        	</table>
        	<p>
        		Surašyti 2 važtaraščio egzemplioriai ir perduoti gyvulių laikytojui ir vežėjui. Vežėjo turimas egzempliorius paliekamas paskirties vietoje.
        	</p>
        	<table class="no-border no-collapse table-text-left">
        		<tr>
        			<td>Galvijus pervežti išdavė</td>
        			<td class="solid-line field_7" width="83%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė)</td>
        		</tr>
        	</table>
        	<table class="no-border no-collapse table-text-left margin-10">
        		<tr>
        			<td>Galvijus pervežti priėmė</td>
        			<td class="solid-line field_8" width="83%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė)</td>
        		</tr>
        	</table>
        </div>
    </div>
</template>

<script>
    import mixins from "../../../mixins.js";

    export default {
        mounted: function()
        {
            var _ = this;

            _.getDocuments();
        },

        data: function()
        {
            return {
                todaySellers: [],
                totalElementsToPrint: 0,
                docImgs: [],
                pivot: {},
                doc_PP: {},
                doc_KV: {
                    animals: []
                }
            };
        },

        methods:
        {
            getDocuments: function()
            {
                var _ = this;
                var targetId = getIdFromURL();

                return offlineDB.find('docsPivot', targetId, 'kv_id').then((pivot) => {
                    _.pivot = pivot;

                    var p = 1;

                    offlineDB.get('animals', (cursor) => {
                        if(cursor.value.seller_code == pivot.seller_code)
                        {
                            if(cursor.value.inclination == '0')
                            {
                                var currAnimal = cursor.value;

                                var row = $("<tr>");

                                let sexMapper = {
                                    'Bulius iki 24mėn.': 'A',
                                    'Bulius virš 24mėn': 'B',
                                    'Kastratas': 'C',
                                    'Karvė': 'D',
                                    'Telyčia': 'E',
                                    'Telyčaitė': 'E'
                                };

                                row.append("<td>"+sexMapper[currAnimal.specie]+"-"+currAnimal.animal_id+"</td>");
                                row.append("<td>"+currAnimal.passport_id+"</td>");
                                row.append("<td>"+currAnimal.specie+"</td>");
                                row.append("<td>"+currAnimal.age+"</td>");
                                row.append("<td>1</td>");
                                row.append("<td>"+currAnimal.real_weight+"</td>");
                                row.append("<td>"+currAnimal.includable_weight+"</td>");
                                $(".animalsTbody").append(row);
                                p++;
                            }
                        }
                    }).then(() => {
                        offlineDB.find('doc_KV', targetId, 'id').then((doc_KV) => {
                            _.doc_KV = doc_KV;

                            offlineDB.find('doc_PP', _.pivot.pp_id, 'id').then((doc_PP) => {
                                _.doc_PP = doc_PP;

                                _.fillDocumentData();
                                mixins.getTotalElementsToPrint(_);
                                mixins.snapScreen(_);
                            });
                        });
                    });
                });
            },

            fillDocumentData: function()
            {
                var _ = this;
                var now = new Date();

                var thisYear = now.getFullYear();
                var thisMonth = mixins.leftPad(now.getMonth() + 1);
                var thisDay = mixins.leftPad(now.getDate());
                var thisHour = mixins.leftPad(now.getHours());
                var thisMinute = mixins.leftPad(now.getMinutes());

                _.pivot.seller_name = mixins.capitalizeFirstChar(_.pivot.seller_name);
                _.pivot.user_name = mixins.capitalizeFirstChar(_.pivot.user_name);
                _.pivot.seller_representative = mixins.capitalizeFirstChar(_.pivot.seller_representative);

                $(".doc_year").text(thisYear);
                $(".doc_month").text(thisMonth);
                $(".doc_day").text(thisDay);

                $(".kvSeries").text(_.doc_KV.serial);
                $(".kvNo").text(_.doc_KV.no);
                $(".ppSeries").text(_.doc_PP.serial);
                $(".ppNo").text(_.doc_PP.no);

                if(Number(_.pivot.travel_start_hour) < 10) _.pivot.travel_start_hour = '0'+Number(_.pivot.travel_start_hour);
                if(Number(_.pivot.travel_start_minute) < 10) _.pivot.travel_start_minute = '0'+Number(_.pivot.travel_start_minute);

                if(Number(_.pivot.travel_arrive_hour) < 10) _.pivot.travel_arrive_hour = '0'+Number(_.pivot.travel_arrive_hour);
                if(Number(_.pivot.travel_arrive_minute) < 10) _.pivot.travel_arrive_minute = '0'+Number(_.pivot.travel_arrive_minute);

                var field1Arr = [];
                if(_.pivot.seller_name) field1Arr.push(_.pivot.seller_name);
                if(_.pivot.seller_address) field1Arr.push(_.pivot.seller_address);
                if(_.pivot.seller_post_code) field1Arr.push(_.pivot.seller_post_code);
                if(_.pivot.seller_phone) field1Arr.push('+3706'+_.pivot.seller_phone);
                if(_.pivot.seller_fax) field1Arr.push(_.pivot.seller_fax);
                if(_.pivot.seller_email) field1Arr.push(_.pivot.seller_email);
                $(".field_1").text(field1Arr.join(', '));

                if(_.pivot.travel_start_date) $('.field_2').text(_.pivot.travel_start_date + " "+_.pivot.travel_start_hour+":"+ _.pivot.travel_start_minute);
                else $('.field_2').text(thisYear+'-'+thisMonth+'-'+thisDay+" "+thisHour+":"+thisMinute);

                $('.field_3').text(_.pivot.seller_pick_up_address);

                var field_4 = "Vairuotojas ";
                if(_.pivot.user_name) field_4 += _.pivot.user_name;
                else field_4 += "______________________________________________________";
                field_4 += " Automobilio Nr. ";
                if(_.pivot.user_plate) field_4 += _.pivot.user_plate;
                else field_4 += "______________________________";
                $('.field_4').text(field_4);

                var field_5 = "___________________________________________";
                if(_.doc_KV.user_travel_paper_number) field_5 += _.doc_KV.user_travel_paper_number;
                $('.field_5').text(field_5);

                $(".field_6").text(_.pivot.travel_arrive_date + ' ' + _.pivot.travel_arrive_hour + ':' + _.pivot.travel_arrive_minute);
                $(".field_7").text(_.pivot.seller_representative);
                $(".field_8").text(_.pivot.user_name);
            }
        }
    }
</script>
