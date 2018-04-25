@extends('documents.documentBody')

@section('main-content')
	<table class="no-border">
		<tr height="50px">
			<td><h1>KROVINIO VAŽTARAŠTIS</h1></td>
		</tr>
		<tr height="20px">
			<td><strong>Serija {{ $documentInfo['doc__k_v']['serial'] }} Nr. {{ $documentInfo['doc__k_v']['no'] }}</strong></td>
		</tr>
		<tr height="30px">
			<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('Y') }} m. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('m') }} mėn. {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $documentInfo['travel_start_datetime'])->format('d') }} d.</td>
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
			<td class="solid-line" width="91%">{{ $animalsSeller }}</td>
		</tr>
		<tr>
			<td colspan="2"	class="text-center text-below">(juridinio asmens pavadinimas arba fizinio asmens vardas, pavardė, adresas, tel., faks., el. pašto adresas)</td>
		</tr>
		<tr height="20px">
			<td class="solid-line" colspan="2"></td>
		</tr>
	</table>
	<p>
		Gyvuliai priimti pagal gyvulių važtaraštį (kitą dokumentą) Serija. {{ $ppSeries }} Nr. {{ $ppNo }}
	</p>
	<p>
		Pakrovimo data ir laikas: {{ $documentInfo['travel_start_datetime'] }}
	</p>
	<table class="no-border no-collapse table-text-left">
		<tr>
			<td>Pakrovimo vieta</td>
			<td class="solid-line" width="84%">{{ $documentInfo['seller_pick_up_address'] }}</td>
		</tr>
		<tr>
			<td colspan="2"	class="text-center text-below">(tikslus krovinio pakrovimo vietos adresas)</td>
		</tr>
	</table>
	<p>
		{{ $userRow }}
	</p>
	<p>
		Gyvulių vežėjo veterinarinio patvirtinimo Nr. 36-09. Kelionės lapo Nr. {{ $vetPassNumber }}
	</p>
	<table class="no-border no-collapse table-text-left">
		<tr>
			<td>Krovinio iškrovimo vieta: Balandiškių km., Pabiržės sen., Biržų raj.</td>
			<td class="solid-line" width="40%">{{ $documentInfo['travel_arrive_datetime'] }}</td>
		</tr>
		<tr>
			<td></td>
			<td class="text-center text-below">(iškrovimo data ir laikas)</td>
		</tr>
	</table>
	<table class="no-outer-border margin-10">
		<tr>
			<td>Gyvulio rūšis ir identifikavimo nr.</td>
			<td>Gyvulio paso serija ir Nr.</td>
			<td>Lytis</td>
			<td>Amžius mėn.</td>
			<td>Galvų skaičius</td>
			<td>Gyvas svoris, kg</td>
			<td>Įskaitinis svoris, kg</td>
		</tr>
		@foreach ($animals as $animal)
			<tr>
				<td>{{ $animal['specialLetter'] }}-{{ $animal['animal_id'] }}</td>
				<td>{{ $animal['passport_id'] }}</td>
				<td>{{ App\Animal::trimUntilFirstLetter($animal['sex']) }}</td>
				<td>{{ Carbon\Carbon::now()->diffInMonths(Carbon\Carbon::createFromFormat('Y-m-d', $animal['dob'])) }}</td>
				<td>1</td>
				<td>{{ $animal['real_weight'] }}</td>
				<td>{{ $animal['includable_weight'] }}</td>
			</tr>
		@endforeach
	</table>
	<p>
		Surašyti 2 važtaraščio egzemplioriai ir perduoti gyvulių laikytojui ir vežėjui. Vežėjo turimas egzempliorius paliekamas paskirties vietoje.
	</p>
	<table class="no-border no-collapse table-text-left">
		<tr>
			<td>Galvijus pervežti išdavė</td>
			<td class="solid-line" width="78%">{{ $documentInfo['seller_representative'] }}</td>
		</tr>
		<tr>
			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė)</td>
		</tr>
	</table>
	<table class="no-border no-collapse table-text-left margin-10">
		<tr>
			<td>Galvijus pervežti priėmė</td>
			<td class="solid-line" width="78%">{{ $documentInfo['user_name'] }}</td>
		</tr>
		<tr>
			<td colspan="2"	class="text-center text-below">(parašas, vardas, pavardė)</td>
		</tr>
	</table>
@endsection
