<template>
    <div id='docContainer'>
        <div id='innerDocContainer'>
            <table class="no-border">
        		<tr height="50px">
        			<td><h1>SĄSKAITA FAKTŪRA</h1> <span class='sfSeries'></span>-<span class='sfNo'></span> </td>
        		</tr>
        		<tr>
        			<td height="30px"><span class='doc_year'></span> m. <span class='doc_month'></span> mėn. <span class='doc_day'></span> d.</td>
        		</tr>
        		<tr>
        			<td class="text-left font-8">
        				<strong>Pirkėjas: UAB &quot;Agaras&quot;, Agaro g. 5, Balandiškių k. Pabiržės sen., Biržų r. LT-41385, Lietuva.</strong>
        			</td>
        		</tr>
        		<tr>
        			<td class="text-left font-8"><strong>Tel. (8-450) 43111, (8-450) 59339, faks. (8-450) 43112</strong> Įmonės kodas <strong>154742821</strong> PVM mokėtojo kodas <strong>LT547428219</strong></td>
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
        	</table>
        	<p>
        		Asmens/Įmonės kodas <span class='field_2'></span> PVM mokėtojo kodas Ne PVM mokėtojas
        	</p>
        	<p>
        		Paso numeris <span class='field_4'></span> Pasas išduotas <span class='field_5'></span>
        	</p>
        	<p>
        		Banko pavadinimas <span class='field_6'></span> Atsiskaitomosios sąskaitos Nr. <span class='field_7'></span>
        	</p>
        	<p>
        		Ūkininko pažymėjimo Nr. <span class='field_8'></span> Vairuotojas <span class='field_9'></span> Automobilio Nr. <span class='field_10'></span>
        	</p>
        	<p>
        		Pakrovimo vieta <span class='field_11'></span> Pakrovimo data: <span class='field_12'></span>
        	</p>
        	<p class="no-margin">
        		„Pirkėjas“ perka, o „Pardavėjas“ parduoda sekančius gyvulius:
        	</p>
        	<table class="no-outer-border hugeTable">
                <thead>
            		<tr>
            			<td rowspan="2" width='115px'>Gyvulio identifikavimo Nr.</td>
            			<td colspan="6">Pirkta gyvulių</td>
            			<td colspan="5">Skerdenų</td>
            			<td rowspan="2">Suma, EUR</td>
            		</tr>
            		<tr>
                        <td>Amžius mėn.</td>
            			<td>Galvų skaičius</td>
            			<td>Įmi-<br />timo katego-<br />rija</td>
            			<td>Gyvasis svoris, kg</td>
            			<td>Įskai-<br />toma gyvojo svorio, kg</td>
            			<td>Gyvojo<br /> svorio<br /> kaina,<br /> EUR/kg</td>
            			<td>Katego-<br />rija</td>
            			<td>Raumenin-<br />gumo klasė</td>
            			<td>Riebu-<br />mo klasė</td>
            			<td>Įskaitinė skerdenos masė, kg</td>
            			<td>Skerdenos kaina, EUR/100kg</td>
            		</tr>
                </thead>
                <tbody class='animalsTbody'></tbody>
                <tr class="table-text-left">
        			<td colspan="5" class="no-border">Turi būti sumokėta gyvulio pardavėjui be PVM</td>
        			<td colspan="7" class="no-border solid-line"></td>
        			<td class='field_18 text-center'></td>
        		</tr>
                <tr class="table-text-left">
                    <td colspan="4" class="no-border">Kompensacinis PVM tarifas 6 proc.</td>
                    <td colspan="8" class="no-border solid-line text-right"></td>
                    <td class='field_20 text-center'></td>
                </tr>
        		<tr class="table-text-left" height="30px">
        			<td colspan="3" class="no-border">Iš viso turi būti sumokėta</td>
        			<td colspan="9" class="no-border solid-line field_13"></td>
        			<td class='field_14'></td>
        		</tr>
        		<tr>
        			<td colspan="3" class="no-border"></td>
        			<td colspan="9"	class="no-border text-center text-below">(suma žodžiais)</td>
        			<td class="no-border"></td>
        		</tr>
        		<tr>
        			<td colspan="13" class="no-border solid-line" height="15px"></td>
        		</tr>
        	</table>
        	<p>
        		Informacija apie gyvulio skerdenos klasifikavimo rezultatus bus išsiųsta šiuo<br />
        		mobilaus telefono nr. <span class='field_15'></span> Smulkesnė informacija teikiama telefonu 8-450 43111.
        	</p>
        	<table class="no-border no-collapse table-text-left">
        		<tr>
        			<td>Įmonės vadovo įgaliotas asmuo</td>
        			<td class="solid-line field_16" width="75%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė ir pareigos)</td>
        		</tr>
        	</table>
        	<table class="no-border no-collapse table-text-left margin-10">
        		<tr>
        			<td>Pardavėjas</td>
        			<td class="solid-line field_17" width="90%"></td>
        		</tr>
        		<tr>
        			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė ir pareigos)</td>
        		</tr>
        	</table>
        	<p>
        		Deklaruoju, kad gyvuliai gimę ir užauginti Lietuvoje
        	</p>
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
                doc_SF: {
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

                return offlineDB.find('docsPivot', targetId, 'sf_id').then((pivot) => {
                    _.pivot = pivot;

                    var totalAnimalsPriceField = 0;

                    offlineDB.get('animals', (cursor) => {
                        if(cursor.value.seller_code == pivot.seller_code)
                        {
                            var currAnimal = cursor.value;

                            if((currAnimal.inclination == '1') || (currAnimal.inclination == '2') || (currAnimal.inclination == '3'))
                            {
                                var row = $("<tr>");

                                var pricePer100Kg = Math.round((parseFloat(currAnimal.includable_weight) * parseFloat(currAnimal.price_kg)) * 100) / 100;
                                if(isNaN(pricePer100Kg)) pricePer100Kg = 0;
                                totalAnimalsPriceField += pricePer100Kg;

                                let sexMapper = {
                                    'Bulius iki 24mėn.': 'A',
                                    'Bulius virš 24mėn': 'B',
                                    'Kastratas': 'C',
                                    'Karvė': 'D',
                                    'Telyčia': 'E',
                                    'Telyčaitė': 'E'
                                };

                                row.append("<td>"+sexMapper[currAnimal.specie]+"-"+currAnimal.animal_id+"</td>");
                                row.append("<td>"+currAnimal.age+"</td>");
                                row.append("<td>1</td>");
                                row.append("<td>"+currAnimal.inclination+"</td>");
                                row.append("<td>"+currAnimal.real_weight+"</td>");
                                row.append("<td>"+currAnimal.includable_weight+"</td>");
                                row.append("<td>"+currAnimal.price_kg+"</td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td></td>");
                                row.append("<td>"+pricePer100Kg.toFixed(2)+"</td>");
                                $(".animalsTbody").append(row);
                            }
                        }
                    }).then(() => {
                        var totalPrice = 0;

                        totalAnimalsPriceField = totalAnimalsPriceField.toFixed(2);

                        $('.field_18').text(totalAnimalsPriceField);

                        if((_.pivot.seller_pvm_code) && (_.pivot.seller_pvm_rate == '6'))
                        {
                            var centSide = totalAnimalsPriceField.split('.')[1];

                            $('.field_20').text(((totalAnimalsPriceField * 1.06) - totalAnimalsPriceField).toFixed(2));

                            totalPrice = (totalAnimalsPriceField * 1.06).toFixed(2);
                        }
                        else totalPrice = totalAnimalsPriceField;

                        var priceCt = (totalPrice+'').split('.')[1];
                        if(!priceCt) priceCt = "0";


                        var priceInWords = _.toWords((totalPrice+'').split('.')[0]) + " " + priceCt+" ct";

                        $(".field_13").text(priceInWords);
                        $(".field_14").text(totalPrice);

                        _.fillDocumentData();
                        mixins.getTotalElementsToPrint(_);
                        mixins.snapScreen(_);
                    });

                    offlineDB.find('doc_SF', targetId, 'id').then((doc_SF) => {
                        _.doc_SF = doc_SF;
                    });
                });
            },

            fillDocumentData: function()
            {
                var _ = this;
                var now = new Date();

                _.pivot.seller_name = mixins.capitalizeFirstChar(_.pivot.seller_name);
                _.pivot.user_name = mixins.capitalizeFirstChar(_.pivot.user_name);
                _.pivot.seller_representative = mixins.capitalizeFirstChar(_.pivot.seller_representative);

                $(".sfSeries").text(_.doc_SF.serial);
                $(".sfNo").text(_.doc_SF.no);

                $(".doc_year").text(now.getFullYear());
                $(".doc_month").text(mixins.leftPad(now.getMonth() + 1));
                $(".doc_day").text(mixins.leftPad(now.getDate()));

                var field1Arr = [];
                if(_.pivot.seller_name) field1Arr.push(_.pivot.seller_name);
                if(_.pivot.seller_address) field1Arr.push(_.pivot.seller_address);
                if(_.pivot.seller_post_code) field1Arr.push(_.pivot.seller_post_code);
                if(_.pivot.seller_phone) field1Arr.push("+3706"+_.pivot.seller_phone);
                if(_.pivot.seller_fax) field1Arr.push(_.pivot.seller_fax);
                if(_.pivot.seller_email) field1Arr.push(_.pivot.seller_email);
                $(".field_1").text(field1Arr.join(', '));

                var field_2 = '______________________________________';
                if(_.pivot.seller_code) field_2 = _.pivot.seller_code;
                $(".field_2").text(field_2);

                var field_3 = '______________________________________';
                if(_.pivot.seller_pvm_code) field_3 = _.pivot.seller_pvm_code;
                $(".field_3").text(field_3);

                var field_4 = '_______________________________________';
                if(_.pivot.seller_pass_series_number) field_4 = _.pivot.seller_pass_series_number;
                $(".field_4").text(field_4);

                var field_5 = '_________________________________________________';
                if(_.pivot.seller_pass_issued_date) field_5 = _.pivot.seller_pass_issued_date;
                $(".field_5").text(field_5);

                var field_6 = '_____________________________';
                if(_.pivot.seller_bank) field_6 = _.pivot.seller_bank;
                $(".field_6").text(field_6);

                var field_7 = '________________________________________';
                if(_.pivot.seller_bank_pay_account_number) field_7 = _.pivot.seller_bank_pay_account_number;
                $(".field_7").text(field_7);

                var field_8 = '_______________';
                if(_.doc_SF.farmer_pass_number) field_8 = _.doc_SF.farmer_pass_number;
                $(".field_8").text(field_8);

                var field_9 = '___________________________________';
                if(_.pivot.user_name) field_9 = _.pivot.user_name;
                $(".field_9").text(field_9);

                $('.field_15').text('+3706'+_.pivot.seller_phone);

                var field_10 = '_________________';
                if(_.pivot.user_plate) field_10 = _.pivot.user_plate;
                $(".field_10").text(field_10);

                var field_11 = '__________________________________________________________________';
                if(_.pivot.seller_pick_up_address) field_11 = _.pivot.seller_pick_up_address;
                $(".field_11").text(field_11);

                var year = now.getFullYear();
                var month = mixins.leftPad(now.getMonth() + 1);
                var day = mixins.leftPad(now.getDate());

                var field_12 = year+'-'+month+'-'+day;
                if(_.pivot.travel_start_date) field_12 = _.pivot.travel_start_date;
                $(".field_12").text(field_12);

                var SF_vat_field16Arr = [];
                if(_.pivot.seller_name) SF_vat_field16Arr.push(_.pivot.user_name);
                if(_.pivot.seller_address) SF_vat_field16Arr.push(_.pivot.user_position);
                $(".field_16").text(SF_vat_field16Arr.join(', '));

                var SF_field17Arr = [];
                if(_.pivot.seller_name) SF_field17Arr.push(_.pivot.seller_representative);
                if(_.pivot.seller_position) SF_field17Arr.push(_.pivot.seller_position);
                $(".field_17").text(SF_field17Arr.join(', '));
            },

            toWords: function(n, isCents, custom_join_character) {
                var string = n.toString(),
                    units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words, currency;

                var and = custom_join_character || '';

                /* Is number zero? */
                if (parseInt(string) === 0) {
                    return 'Nulis';
                }

                if(isCents) currency = [' centų', ' centas', ' centai'];
                else currency = [' Eur', ' Eur', ' Eur'];

                /* Array of units as words */
                units = ['', 'vienas', 'du', 'trys', 'keturi', 'penki', 'šeši', 'septyni',
                    'aštuoni', 'devyni', 'dešimt', 'vienuolika', 'dvylika', 'trylika', 'keturiolika',
                    'penkiolika', 'šešiolika', 'septyniolika', 'aštuoniolika', 'devyniolika'];

                /* Array of tens as words */
                tens = ['', '', 'dvidešimt', 'trisdešimt', 'keturiasdešimt', 'penkiasdešimt',
                    'šešiasdešimt', 'septyniasdešimt', 'aštuoniasdešimt', 'devyniasdešimt'];

                /* Array of scales as words */
                scales = ['', 'tūkstantis'];

                /* Split user arguemnt into 3 digit chunks from right to left */
                start = string.length;
                chunks = [];
                while (start > 0) {
                    end = start;
                    chunks.push(string.slice((start = Math.max(0, start - 3)), end));
                }

                /* Check if function has enough scale words to be able to stringify the user argument */
                chunksLen = chunks.length;
                if (chunksLen > scales.length) return '';

                /* Stringify each integer in each chunk */
                words = [];
                for (i = 0; i < chunksLen; i++) {
                    chunk = parseInt(chunks[i]);

                    if (chunk) {
                        /* Split chunk into array of individual integers */
                        ints = chunks[i].split('').reverse().map(parseFloat);

                        /* If tens integer is 1, i.e. 10, then add 10 to units integer */
                        if (ints[1] === 1) ints[0] += 10;

                        /* Add scale word if chunk is not zero and array item exists */
                        if ((word = scales[i]))
                        {
                            if((chunk % 10 == 0) || ((chunk >= 10) && (chunk <= 20))) words.push('tūkstančių');
                            else if(chunk % 10 == 1) words.push('tūkstantis');
                            else words.push('tūkstančiai');
                        }

                        /* Add unit word if array item exists */
                        if ((word = units[ints[0]]))
                        {
                            if(chunk == Number(chunks[0]))
                            {
                                if((chunk % 10 == 0) || ((chunk >= 10) && (chunk <= 20))) word += currency[0];
                                else if(chunk % 10 == 1) word += currency[1];
                                else word += currency[2];
                            }

                            words.push(word);
                        }

                        /* Add tens word if array item exists */
                        if ((word = tens[ints[1]])) words.push(word);

                        /* Add 'and' string after units or tens integer if: */
                        if (ints[0] || ints[1]) {
                            /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                            if (ints[2] || !i && chunksLen) words.push(and);
                        }

                        /* Add hundreds word if array item exists */
                        if ((word = units[ints[2]])) {
                            if(chunk > 199) words.push(word + ' šimtai');
                            else words.push(word + ' šimtas');
                        }
                    }
                }

                return words.reverse().join(' ').replace('  ', ' ');
            }
        }
    }
</script>
