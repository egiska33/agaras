<table class="no-border">
	<tr height="50px">
		<td><h1>PVM SĄSKAITA FAKTŪRA</h1></td>
	</tr>
	<tr height="20px">
		<td><strong><small>Serija</small> GYV Nr. 0086466</strong></td>
	</tr>
	<tr>
		<td height="30px">{{ \Carbon\Carbon::now()->format('Y') }} m. {{ \Carbon\Carbon::now()->format('m') }} mėn. {{ \Carbon\Carbon::now()->format('d') }} d.</td>
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
		<td class="solid-line" width="91%">{{ $animalsSeller }}</td>
	</tr>
	<tr>
		<td colspan="2"	class="text-center text-below">(juridinio asmens pavadinimas arba fizinio asmens vardas, pavardė, adresas, tel., faks., el. pašto adresas)</td>
	</tr>
</table>
<p>
	Asmens/Įmonės kodas {{ $companyCodeRow }} PVM mokėtojo kodas {{ $pvmPayerCode }}
</p>
<p>
	Paso numeris {{ $passSerieAndNumberRow }} Pasas išduotas {{ $passDateRow }}
</p>
<p>
	Banko pavadinimas {{ $bankRow }} Atsiskaitomosios sąskaitos Nr. {{ $bankAccountRow }}
</p>
<p>
	Ūkininko pažymėjimo Nr. {{ $farmerPassRow }} Vairuotojas {{ $driverRow }} Automobilio Nr. {{ $carPlatesRow }}
</p>
<p>
	Pakrovimo vieta {{ $loadAddressRow }} Pakrovimo data: {{ $loadDateRow }}
</p>
<p class="no-margin">
	„Pirkėjas“ perka, o „Pardavėjas“ parduoda sekančius gyvulius:
</p>
<table class="no-outer-border">
	<tr>
		<td rowspan="2">Gyvulio identifikavimo Nr.</td>
		<td colspan="6">Pirkta gyvulių</td>
		<td colspan="5">Skerdienų</td>
		<td rowspan="2">Suma, EUR</td>
	</tr>
	<tr>
		<td>Amžius mėn.</td>
		<td>Galvų skaičius</td>
		<td>Įmitimo kategorija</td>
		<td>Gyvasis svoris, kg</td>
		<td>Įskaitoma gyvojo svorio, kg</td>
		<td>Gyvojo svorio kaina, EUR/kg</td>
		<td>Kategorija</td>
		<td>Raumeningumo klasė</td>
		<td>Riebumo klasė</td>
		<td>Įskaitinė skerdienos masė, kg</td>
		<td>Skerdienos kaina, EUR/100kg</td>
	</tr>

	@foreach ($animals as $animal)
		<tr>
			<td>{{ $animal['animal_id'] }}</td>
			<td>{{ Carbon\Carbon::now()->diffInMonths(Carbon\Carbon::createFromFormat('Y-m-d', $animal['dob'])) }}</td>
			<td>1</td>
			<td>{{ $animal['inclination'] }}</td>
			<td>{{ $animal['real_weight'] }}</td>
			<td>{{ $animal['includable_weight'] }}</td>
			<td>{{ $animal['price_kg'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>{{ $animal['includable_weight'] * $animal['price_kg'] }}</td>
		</tr>
	@endforeach

	<tr class="table-text-left">
		<td colspan="5" class="no-border">Turi būti sumokėta gyvulio pardavėjui be PVM</td>
		<td colspan="7" class="no-border solid-line"></td>
		<td>{{ $totalAnimalsPrice }}</td>
	</tr>
	<tr class="table-text-left">
		<td colspan="2" class="no-border">PVM tarifas 21 proc.</td>
		<td colspan="10" class="no-border solid-line"></td>
		<td>{{ $priceVat21 }}</td>
	</tr>
	<tr class="table-text-left">
		<td colspan="4" class="no-border">Kompensacinis PVM tarifas 6 proc.</td>
		<td colspan="8" class="no-border solid-line text-right"></td>
		<td>{{ $priceVat6 }}</td>
	</tr>
	<tr class="table-text-left" height="30px">
		<td colspan="4" class="no-border">Iš viso turi būti sumokėta PVM</td>
		<td colspan="8" class="no-border solid-line">{{ $euroInWords }} {{ $centsInWords }}</td>
		<td>{{ $totalPrice }}</td>
	</tr>
	<tr>
		<td colspan="4" class="no-border"></td>
		<td colspan="8"	class="no-border text-center text-below">(suma žodžiais)</td>
		<td class="no-border"></td>
	</tr>
	<tr>
		<td colspan="13" class="no-border solid-line" height="15px"></td>
	</tr>
</table>
<p>
	Informacija apie gyvulio skerdienos klasifikavimo rezultatus bus išsiųsta šiuo<br />
	mobilaus telefono nr. {{ $documentInfo['seller_phone'] }} Smulkesnė informacija teikiama telefonu 8-450 43111.
</p>
<table class="no-border no-collapse table-text-left">
	<tr>
		<td>Įmonės vadovo įgaliotas asmuo</td>
		<td class="solid-line" width="75%">{{ $documentInfo['user_name'] }} {{ $documentInfo['user_position'] }}</td>
	</tr>
	<tr>
		<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė ir pareigos)</td>
	</tr>
</table>
<table class="no-border no-collapse table-text-left margin-10">
	<tr>
		<td>Pardavėjas</td>
		<td class="solid-line" width="90%">{{ $documentInfo['seller_name'] }}</td>
	</tr>
	<tr>
		<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė ir pareigos)</td>
	</tr>
</table>
<p>
	PVM įstatymo nuoroda “Sąskaitų faktūrų išsirašymas”. Deklaruoju, kad gyvuliai gimę ir užauginti Lietuvoje
</p>
