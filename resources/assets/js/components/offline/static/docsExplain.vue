<template>
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Dokumentų paaiškinimai</h3>
					</div>
                    <div class="box-body staticPage">
						<div>
							<p><b>Yra formuojami tokie skirtingi dokumentai:</b></p>
							<ul>
								<li>VG Važtaraštis (pagal gyvą svorį) - Lietuvos Respublikoje vežamų gyvūnų važtaraštis.</li>
								<li>Sąskaita faktūra - sąskaita faktūra arba PVM sąskaita faktūra. Priklausomai nuo tiekėjo pardavėjo statuso: PVM mokėtojas ar ne.</li>
								<li>PI Kvitas - Pinigų išmokėjimo kvitas.</li>
								<li>PP Sutartis - gyvulių pirkimo-pardavimo sutartis.</li>
								<li>Krovinio važtaraštis (pagal skerdieną) - krovinio važtaraštis.</li>
								<li>Paraiška.</li>
							</ul>
						</div>

						<div>
							<p><b>VG Važtaraštis:</b></p>
							<ul>
								<li><i>Data ir vieta</i> - įrašome šios dienos datą automatiškai.</li>
								<li><i>Gyvūnų laikytojas</i> - vardas, pavardė / įmonės pavadinimas, kodas - gauname automatiškai.  veterinarinio patvirtinimo Nr. reikia įrašyti per dokumento redagavimą arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Gyvūnų laikytojo adresas</i> - rajonas, savivaldybė, seniūnija, vietovė, gatvė, namo numeris - gauname automatiškai. Papildomai pridedame pašto kodą, jei pavyksta gauti iš sistemos.</li>
								<li><i>Gyvūnų laikymo vieta</i> - bandos numeris gaunamas automatiškai. Laikymo vietos numeris - galima įvesti per dokumento redagavimą arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Gyvūnų laikymo vietos adresas</i> - prie pardavėjo Jūsų nurodyta vieta. Būtinas punktas ir jį gauname automatiškai.</li>
								<li><i>Gyvūnų vežėjas: UAB „Agaras“, 154742821, 36-LT90-402</i> - transporto priemonės Nr. ir priekabos Nr. - gauname automatiškai.</li>
								<li><i>Planuojama kelionės trukmė (val.)</i> - reikia nurodyti per dokumento redagavimą arba ranka (su tušiniu, pieštuku).</li>
								<li><i>Išvykimo data ir laikas</i> - paskaičiuojamas automatiškai. Nuo dokumento suformavimo laiko pridedame 30 min.</li>
								<li><i>Planuojama atvykimo į paskirties vietą data ir laikas</i> - reikia nurodyti per dokumento redagavimą arba ranka (su tušiniu, pieštuku).</li>
								<li><i>Gyvūnų laikytojas / įmonei atstovaujantis asmuo</i> - nurodytas pardavėjo atstovas. Gauname automatiškai iš pardavėjo profilio.</li>
								<li><i>Transporto priemonės vairuotojas</i> - vairuotojas.</li>
							</ul>
						</div>

						<div>
							<p><b>Sąskaita faktūra</b></p>
							<ul>
								<li><i>Serija ir numeris</i> - gauname automatiškai.</li>
								<li><i>Data</i> - įrašome šios dienos datą automatiškai.</li>
								<li><i>Pardavėjas</i> - juridinio asmens pavadinimas arba fizinio asmens vardas, pavardė, adresas, tel. - gauname automatiškai. Faks., el. pašto adresas - gauname, jei tai yra įrašyta pardavėjo profilyje.</li>
								<li><i>Asmens/Įmonės kodas</i> - gauname automatiškai.</li>
								<li><i>PVM mokėtojo kodas</i> - jei tiekėjas / pardavėjas yra PVM mokėtojas, tai atvaizduojame kodą ir sąskaita faktūra būna PVM. Jei ne - sąskaita būna paprasta (be PVM) ir čia automatiškai nurodome ne PVM mokėtojas.</li>
								<li><i>Paso serija ir Nr. bei Pasas išduotas</i> - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Banko pavadinimas ir Atsiskaitomosios sąskaitos Nr.</i> -  gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Ūkininko pažymėjimo Nr.</i> - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Vairuotojas ir Automobilio Nr.</i>  - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušiniu, pieštuku).</li>
								<li><i>Pakrovimo vieta</i> - gauname automatiškai. Tai yra gyvūnų laikymo adresas. Galima redaguoti.</li>
								<li><i>Pakrovimo data</i> - šios dienos data. Gauname automatiškai.</li>
								<li><i>Mobilaus telefono nr., kuriuo bus išsiųsta informacija</i> - gauname automatiškai iš pardavėjo profilio, kur nurodyta pardavėjo mob. nr.</li>
								<li><i>Pirkėjas</i> - vairuotojas. Gauname automatiškai.</li>
								<li><i>Pardavėjas</i> - pardavėjo / tiekėjo atstovas. Gauname automatiškai.</li>
							</ul>
						</div>

						<div>
							<p><b>PI Kvitas</b></p>
							<ul>
								<li><i>Serija ir numeris</i> - gauname automatiškai.</li>
								<li><i>Data</i> - įrašome šios dienos datą automatiškai.</li>
								<li>
									<i>Išmokėti už</i> - gauname automatiškai, bet yra 2 atvejai:
									<ol>
										<li>jei yra sugeneruojama sąskaita faktūra, tai nurodome šios seriją ir numerį.</li>
										<li>jei nėra sąskaitos faktūros, tai nurodome “gyvulius”.</li>
									</ol>
								</li>
								<li><i>Išmokėta suma</i> - automatiškai sugeneruojama suma žodžiais ir skaičiais. Skaičius galima redaguoti, jei yra kitoks susitarimas, nes įvertinta visa suma (įskaitinis svoris x eur/kg) už gyvulius.</li>
								<li><i>Išmokėjau</i> - vairuotojas. Gauname automatiškai.</li>
								<li><i>Pinigus gavau</i> - pardavėjo atstovas. Gauname automatiškai.</li>
							</ul>
						</div>

						<div>
							<p><b>PP Sutartis - gyvulių pirkimo-pardavimo sutartis</b></p>
							<ul>
								<li><i>Serija ir numeris</i> - gauname automatiškai.</li>
								<li><i>Data</i> - įrašome šios dienos datą automatiškai.</li>
								<li><i>“Pardavėju” atstovaujama</i> - pardavėjo atstovas. Gauname automatiškai.</li>
								<li><i>Bazines kainas Bulių; Telyčių; Karvių</i> - reikia įrašyti per dokumento redagavimą arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Vardas, pavardė/Įmonė</i> - gauname automatiškai.</li>
								<li><i>Asmens/Įmonės kodas</i> - gauname automatiškai.</li>
								<li><i>PVM kodas</i> -  jei tiekėjas / pardavėjas yra PVM mokėtojas, tai atvaizduojame kodą. Jei ne - automatiškai nurodome ne PVM mokėtojas.</li>
								<li><i>Paso serija ir Nr.  išduotas</i> - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Adresas</i> - gauname automatiškai.</li>
								<li><i>Bankas, A/S</i> - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Telefonas, faksas</i> - gauname automatiškai, jei tai įrašyta pardavėjo profilyje. Galima įvesti redaguojant arba ranka (su tušinuku, pieštuku).</li>
							</ul>
						</div>

						<div>
							<p><b>Krovinio važtaraštis (pagal skerdieną) - krovinio važtaraštis</b></p>
							<ul>
								<li><i>Serija ir numeris</i> - gauname automatiškai.</li>
								<li><i>Data</i> - įrašome šios dienos datą automatiškai.</li>
								<li><i>Pardavėjas</i> - juridinio asmens pavadinimas arba fizinio asmens vardas, pavardė. - gauname automatiškai.</li>
								<li><i>Gyvuliai paimti pagal</i> -  gyvulių pirkimo-pardavimo sutartis (PP Sutartis). Gauname automatiškai.</li>
								<li><i>Pakrovimo data ir laikas</i> - gauname automatiškai. Prie dokumento suformavimo laiko pridedame 15 min.</li>
								<li><i>Pakrovimo vieta</i> -  gauname automatiškai.</li>
								<li><i>Vairuotojas ir automobilis</i> - gauname automatiškai.</li>
								<li><i>Iškrovimo data ir laikas</i> -  reikia įrašyti per dokumento redagavimą arba ranka (su tušinuku, pieštuku).</li>
								<li><i>Galvijus pervežti išdavė</i> - pardavėjo atstovas. Gauname automatiškai.</li>
								<li><i>Galvijus pervežti priėmė</i> - vairuotojas. Gauname automatiškai.</li>
							</ul>
						</div>

						<div>
							<p><b>Paraiška</b></p>
							<ul>
								<li><i>Gyvuliai pirkti</i> - įrašome šios dienos datą automatiškai.</li>
								<li><i>Supirkėjas</i> - nurodome formuojant paraišką.</li>
								<li><i>Gyvuliai pristatyti iš</i> - nurodome formuojant paraišką.</li>
								<li><i>Gyvuliai pristatyti į skerdyklą</i> - nurodome formuojant paraišką.</li>
								<li><i>Agentai</i> - nurodome prie pardavėjo formuojant paraišką.</li>
							</ul>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
</template>
