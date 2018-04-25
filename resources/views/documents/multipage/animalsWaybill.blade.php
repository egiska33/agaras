<div class="vg">
    <table class="no-border">
        <tr>
            <td></td>
            <td class="font-5 text-right" width="65%">
                Forma patvirtinta Valstybinės maisto ir veterinarijos tarnybos direktoriaus 2006 m. kovo 16 d. įsakymu
                Nr. B1-207<br/>
                (Valstybinės maisto ir veterinarijos tarnybos direktoriaus 2015 m. gegužės 19 d. įsakymo Nr. B1-433
                redakcija)
            </td>
        </tr>
    </table>
    <table class="no-border">
        <tr>
            <td><h2>LIETUVOS RESPUBLIKOJE VEŽAMŲ GYVŪNŲ VAŽTARAŠTIS</h2></td>
        </tr>
        <tr>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('Y') }}
                m. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('m') }}
                mėn. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('d') }}
                d.
            </td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Gyvūnų laikytojas</td>
            <td class="solid-line" width="83%">{{ $animalsHolder }}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center text-below">(vardas, pavardė / įmonės pavadinimas, kodas, veterinarinio
                patvirtinimo Nr.*)
            </td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Gyvūnų laikytojo adresas</td>
            <td class="solid-line" width="76%">{{ $sellerAddress }}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center text-below">(rajonas, savivaldybė, seniūnija, vietovė, gatvė, namo
                numeris)
            </td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left">
        <tr>
            <td>Gyvūnų laikymo vieta</td>
            <td class="solid-line" width="80%"><span
                        style='width: 50%;display:inline-block'>{{ $documentInfo['doc__v_g']['held_place_number'] }}</span><span
                        style='width: 50%;display:inline-block'>{{ $documentInfo['doc__v_g']['herd_number'] }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-right">
                <span class="text-below margin-right">(laikymo vietos numeris*)</span>
                <span class="text-below margin-right">(bandos numeris*)</span>
            </td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left">
        <tr>
            <td>Gyvūnų laikymo vietos adresas**</td>
            <td class="solid-line" width="69%">{{ $documentInfo['doc__v_g']['held_adress'] }}</td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Gyvūnų vežėjas: UAB &quot;Agaras&quot;, 154742821, 36-LT90-402.</td>
            <td class="solid-line"
                width="47%">{{ $documentInfo['user_plate'] }} @if ((!empty($documentInfo['user_plate'])) && (!empty($documentInfo['user_trailer_plates'])))
                    , @endif {{ $documentInfo['user_trailer_plates'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center text-below">(valst. nr., priekabos nr.)</td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Paskirties vieta: UAB &quot;Agaras&quot;, Agaro g. 5, Balandiškių k. Pabiržės sen., Biržų r. LT-41385,
                Lietuva.
            </td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Planuojama kelionė trukmė (val.):</td>
            <td class="solid-line" width="12%">{{ $documentInfo['doc__v_g']['travel_duration'] }}</td>
            <td>Išvykimo data ir laikas:</td>
            <td class="solid-line" width="35%">{{ $documentInfo['travel_start_datetime'] }}</td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Planuojama atvykimo į paskirties vietą data ir laikas:</td>
            <td class="solid-line" width="24%">{{ $documentInfo['travel_arrive_datetime'] }}</td>
            <td>Gyvūnų rūšis</td>
            <td class="solid-line" width="15%">Galvijai</td>
        </tr>
    </table>
    <table class="no-outer-border margin-10">
        <tr>
            <td rowspan="2">Eil. Nr.</td>
            <td colspan="6">Gyvūno</td>
        </tr>
        <tr>
            <td>individualaus ženklinimo Nr.*/bandos Nr.*</td>
            <td>paso Nr.*</td>
            <td>lytis</td>
            <td>veislė</td>
            <td>gimimo šalis, data</td>
            <td>užauginimo vieta (nurodyti šalies pavadinimą)***</td>
        </tr>
        @foreach ($animals as $animal)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $animal['specialLetter'] }}-{{ $animal['animal_id'] }}</td>
                <td>{{ $animal['passport_id'] }}</td>
                <td>{{ App\Animal::trimUntilFirstLetter($animal['sex']) }}</td>
                <td>{{ $animal['breed'] }}</td>
                <td>{{ $animal['cob'] }}, {{ $animal['dob'] }}</td>
                <td>{{ $animal['pog'] }}</td>
            </tr>
        @endforeach
    </table>
    <p class="no-margin">
        Gyvunų skaičius/kiekis {{ sizeof($animals) }} vnt. / kg
    </p>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Aš,</td>
            <td class="solid-line" width="55%">{{ $documentInfo['seller_representative'] }}</td>
            <td width="43%">, p a t v i r t i n u, kad:</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center text-below">(gyvūnų laikytojo vardas, pavardė / įmonei atstovaujančio asmens vardas
                ir pavardė)
            </td>
            <td></td>
        </tr>
    </table>
    <ol class="list-rules">
        <li>
            Gyvūnų laikymo vietoje išvežamiems gyvūnams netaikomi / <span
                    style='text-decoration: line-through; font-weight: normal !important;'>taikomi</span> (nereikalingą
            žodį išbraukti) pagal
            <span class="solid-line" style="width: 50%; height: 10px; display: inline-block;"></span>
            apribojimai dėl gyvūnų užkrečiamųjų ligų;
        </li>
        <li>
            Arklinių šeimos gyvūnai neturėjo sąlyčio su arklinių šeimos gyvūnais, sergančiais užkrečiamąja liga, ne
            mažiau kaip 15 d.;
        </li>
        <li>
            Arklinių šeimos gyvūnai nebuvo / buvo (nereikalingą žodį išbraukti) gydomi paskutinius 6 mėnesius
            vadovaujantis 2006 m. gruodžio
            13 d. Komisijos reglamentu (EB) Nr. 1950/2006, nustatančiu arklinių šeimos gyvūnams gydyti būtinų medžiagų
            sąrašą pagal Europos Parlamento ir
            Tarybos direktyvą 2001/82/EB dėl Bendrijos kodekso, reglamentuojančio veterinarinius vaistus (OL 2006 L 367,
            p. 33), su paskutiniais pakeitimais,
            padarytais 2013 m. vasario 12 d. Komisijos reglamentu (ES) Nr. 122/2013 (OL 2013 L 42, p. 1);
        </li>
        <li>
            Gyvūnams nebuvo naudojami augimo stimuliatoriai;
        </li>
        <li>
            Paskutinius 2 mėnesius gyvūnams gydyti buvo naudojamas (-ami) veterinarinis (-iai) vaistas (-ai)
            <span class="solid-line" style="width: 45%; height: 14px; display: inline-block;">nenaudoti</span>
            , kurio (-ių) išlauka pasibaigė <span class="solid-line"
                                                  style="width: 10%; height: 10px; display: inline-block;"></span>
        </li>
        <li>
            Minėti gyvūnai tinkami vežti nustatytu maršrutu laikantis 2004 m. gruodžio 22 d. Tarybos reglamento (EB) Nr.
            1/2005 dėl gyvūnų
            apsaugos juos vežant ir atliekant susijusias operacijas, ir iš dalies keičiančio direktyvas 64/432/EEB ir
            93/119/EB ir reglamentą (EB) Nr. 1255/97 (OL
            2005 L 3, p. 1), reikalavimų.
        </li>
        <li>
            Šis važtaraštis surašytas 2 (dviem) egzemplioriais, iš kurių vienas duodamas gyvūnų laikytojui, kitas –
            transporto priemonės vairuotojui,
            kuris jį palieka paskirties vietoje.
        </li>
    </ol>
    <table class="no-border no-collapse table-text-left">
        <tr>
            <td>Gyvūnų laikytojas / įmonei atstovaujantis asmuo</td>
            <td class="solid-line" width="55%">{{ $documentInfo['seller_representative'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center text-below">(parašas, vardas, pavardė)</td>
        </tr>
    </table>
    <table class="no-border no-collapse table-text-left margin-10">
        <tr>
            <td>Transporto priemonės vairuotojas</td>
            <td class="solid-line" width="68%">{{ $documentInfo['user_name'] }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-center text-below">(parašas, vardas, pavardė)</td>
        </tr>
    </table>
    <p class="font-5 no-margin">* – jei suteiktas;</p>
    <p class="font-5 no-margin">** – nurodoma, jei gyvūnų laikymo vieta nėra registruota Ūkinių gyvūnų registre;</p>
    <p class="font-5 no-margin">
        *** – nurodoma tik vežant kiaules, avis, ožkas ir naminius paukščius. Gyvūno užauginimo vieta nurodoma
        vadovaujantis 2013 m. gruodžio 13 d. Komisijos įgyvendinimo reglamento (ES) Nr. 1337/2013,
        kuriuo nustatomos Europos Parlamento ir Tarybos reglamento (ES) Nr. 1169/2011 taikymo taisyklės, susijusios su
        šviežios, atšaldytos ir užšaldytos kiaulienos, avienos, ožkienos ir paukštienos kilmės
        šalies arba kilmės vietos nuorodomis (OL 2013 L 335, p. 19), 5 straipsniu
    </p>
</div>
<script>

</script>