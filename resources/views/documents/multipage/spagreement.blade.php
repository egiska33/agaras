<div id="pp_id">
    <table class="no-border">
        <tr>
            <td><h2>GYVULIŲ PIRKIMO — PARDAVIMO
                    SUTARTIS&nbsp;&nbsp;{{ $documentInfo['doc__p_p']['serial'] }} {{ $documentInfo['doc__p_p']['no'] }}</h2>
            </td>
        </tr>
        <tr>
            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('Y') }}
                m. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('m') }}
                mėn. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('d') }}
                d.
            </td>
        </tr>
    </table>
    <p>
        {{ $sellerRow }}, toliau vadinama "Pardavėju" atstovaujama @if(empty($documentInfo['seller_representative']))
            ________________________________________ @else{{$documentInfo['seller_representative'] }}@endif ir UAB
        "Agaras",
        toliau vadinama "Pirkėju", pagal įgaliojimą atstovaujama {{ $driverRow}}, sudarėme šią sutartį:
    </p>
    <ol class="level-1">
        <li>
            <span>SUTARTIES OBJEKTAS</span>
            <p>
                Pardavėjas įsipareigoja patiekti Pirkėjui gyvulius, kurių kokybė atitinka galiojančius standartus,
                technines sąlygas bei
                veterinarinius reikalavimus, o Pirkėjas įsipareigoja nupirkti gyvulius ir sumokėti už jų skerdenos svorį
                pagal bazines
                skerdienos kainas.
            </p>
        </li>
        <li>
            <span>ŠALIŲ ĮSIPAREIGOJIMAI</span>
            <ol>
                <li>
                    <span>Pardavėjas įsipareigoja:</span>
                    <ol>
                        <li>Sutartu laiku paruošti gyvulius pardavimui laikantis teises aktų, reglamentuojančių gyvulių
                            pirkimo -pardavimo tvarką.
                        </li>
                        <li>Neparduoti gyvulių šertų pašarais ir pašariniais priedais, kurie blogiua skerdenos kokybę.
                        </li>
                        <li>Pateikti tikslius duomenis apie ūkio registravimą, asmens duomenis ir banko sąskaitą.</li>
                        <li>Garantuoti gyvulio amžiaus ir identifikavimo numerio tikslumą.</li>
                    </ol>
                </li>
                <li>
                    <span>Pirkėjas įsipareigoja:</span>
                    <ol>
                        <li>Nupirkti gyvulius laikantis teisės aktų, reglamentuojančių gyvulių pirkimo - pardavimo
                            tvarką, reikalavimų.
                        </li>
                        <li>
                            Mokėti už gyvulius pagal vertintų skerdenų svorius ir kokybę šias bazines (R raumeningumo ir
                            3 riebumo klasės) kainas:<br/>
                            <strong>Bulių</strong> {{ $bullPriceRow }} EUR/kg;
                            <strong>Telyčių</strong> {{ $heiferPriceRow }} EUR/kg;
                            <strong>Karvių</strong> {{ $cowPriceRow }} EUR/kg.<br/>
                            Visa galvijų skerdenų kainų lentelė pateikiama priede prie šios gyvulių pirkimo - pardavimo
                            sutarties.
                        </li>
                        <li>Atsiskaityti su Pardavėju mokėjimo pavedimu pervedant pinigus į Pardavėjo nurodytą bankinę
                            sąskaitą per 15 darbo dienų.
                        </li>
                        <li>
                            Pirkdamas gyvulius pagal skerdenų svorį ir kokybę, ne vėliau kaip per 2 darbo dienas po
                            gyvulio paskerdimo ir
                            jo skerdenos įvertinimo, išrašyti PVM sąskaitą - faktūrą ar sąskaitą faktūrą.
                        </li>
                        <li>
                            Galvijus skerdžiant, Pirkėjas patikrina visus kitus galvijų atitikimui keliamus
                            reikalavimus, kurių nebuvo
                            galima patikrinti galvijus priimant ir nustato galvijų skerdenos svorį. Pirkėjas nustatęs
                            neatitikimus per 24 valandas
                            apie tai informuoja Pardavėją, ir ne vėliau kaip kitą dieną po pranešimo gavinio, šalys
                            surašo neatitikimų aktą
                            nurodydami savo pastabas. Pardavėjui nustatytu terminu nepasirašius neatitikimų akto,
                            laikoma, kad Pirkėjo nurodyti
                            neatitikimai yra pagrįsti ir teisingi. Pardavėjas turi teisę per 24 valandas patikrinti
                            neatitikimų faktą.
                        </li>
                        <li>
                            Nustačius 2.2.5 punkte nurodytus neatitikimus, Pirkėjas turi teisę sumažinti neatitinkančių
                            reikalavimų galvijų
                            kainą. Jeigu neatitinkančio reikalavimų paskersto galvijo Pardavėjas nesutinka su Pirkėjo
                            kainos sumažinimu, tai
                            Pirkėjas grąžina Pardavėjui galvijo skerdeną ir už tą galviją nemoka. Tokiu atveju
                            Pardavėjas apmoka Pirkėjui už
                            gyvulio transportavimą ir skerdimą.
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
        <li>
            <span>ŠALIŲ TURTINĖ ATSAKOMYBĖ</span>
            <ol>
                <li>
                    Pardavėjas ir Pirkėjas atleidžiami nuo atsakomybės, jei įsipareigojimų neįvykdė dėl nenugalimos
                    jėgos: karo,
                    stichinės nelaimės, boikotų, streikų, teisėtų ar neteisėtų valstybės valdymo institucijų veiksmų,
                    gyvulių susirgimo,
                    kritimo ir kt., kaip tai numatyta teisės aktuose.
                </li>
            </ol>
        </li>
        <li>
            <span>KITOS SUTARTIES SĄLYGOS</span>
            <ol>
                <li>Sutartis įsigalioja nuo jos pasirašymo datos ir galioja iki atsiskaitymo su Pardavėju.</li>
                <li>Sutartis sudaroma dviem egzemplioriais, turinčiais vienodą juridinę galią, po vieną kiekvienai
                    sutarties šaliai.
                </li>
                <li>Informacija apie skerdienų įvertinimo rezultatus teikiama telefonu 8-450- 59339.</li>
            </ol>
        </li>
        <li><span>ŠALIŲ REKVIZITAI:</span></li>
    </ol>
    <table class="no-border requisites-table">
        <tr>
            <th width="60%">Pardavėjas:</th>
            <th width="40%">Pirkėjas:</th>
        </tr>
        <tr>
            <td>Vardas, pavardė/įmonė: {{ $documentInfo['seller_name'] }}</td>
            <td>UAB "Agaras"</td>
        </tr>
        <tr>
            <td>Asmens/Įmonės kodas: {{ $documentInfo['seller_code'] }}</td>
            <td>Balandiškių k. Pabiržės sen. Biržų r. LT-41385</td>
        </tr>
        <tr>
            <td>PVM Kodas:
                @if(!empty($documentInfo['seller_pvm_code']))
                    {{ $documentInfo['seller_pvm_code'] }}
                @else
                    Ne PVM mokėtojas
                @endif</td>
            <td>Įmonės kodas: 154742821</td>
        </tr>
        <tr>
            <td>Paso numeris {{ $passSeriesNumberRow }} išduotas {{ $passSeriesDateRow }}</td>
            <td>Tel. 8-450-59118, faks. 8-450-43112</td>
        </tr>
        <tr>
            <td>Bankas {{ $bankRow }}</td>
            <td>A/s LT467044060002446386</td>
        </tr>
        <tr>
            <td>A/s {{ $bankAccountRow }}</td>
            <td>Įmonės atstovas {{ $buyerRow }}</td>
        </tr>
        <tr>
            <td>Telefonas, faksas: {{ $documentInfo['seller_phone'] }}, {{ $documentInfo['seller_fax'] }}</td>
            <td></td>
        </tr>
        <tr height="50px">
            <td class="text-center signature">
                <span>(parašas)</span>
            </td>
            <td class="text-center signature">
                <span>(parašas)</span>
            </td>
        </tr>
    </table>
</div>