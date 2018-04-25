@extends('documents.documentBody')

@section('main-content')
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
			<strong>Gyvuliai pirkti</strong> {{ \Carbon\Carbon::now()->format('Y') }}m {{ \Carbon\Carbon::now()->format('m') }}mėn. {{ \Carbon\Carbon::now()->format('d') }}d.
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<strong>Supirkėjas</strong>
			@if(!empty($buyer_name))
				{{ $buyer_name }}
			@else
				...............................
			@endif
			<strong>Gyvuliai pristatyti iš</strong>
			@if(!empty($buyer_animals_from))
				{{ $buyer_animals_from }}
			@else
				............................
			@endif
			<strong>rajono</strong>
			Gyvuliai pristatyti į skerdyklą
			@if(!empty($buyer_animals_deliver_date))
				{{ $buyer_animals_deliver_date }}
			@else
				........
			@endif
			d
			@if(!empty($buyer_animals_deliver_hour))
				{{ $buyer_animals_deliver_hour }}
			@else
				........
			@endif
			val.
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<table>
				<tr>
					<td rowspan="2">Eil. Nr.</td>
					<td rowspan="2">Agentai</td>
					<td rowspan="2">Gyvulio ident. Nr.</td>
					<td rowspan="2">Gyv. rūšis</td>
					<td colspan="2">Važtaraštyje</td>
					<td colspan="3">Skerdykloje</td>
					<td rowspan="2">Pastabos - kainininkas</td>
				</tr>
				<tr>
					<td>Įmit. kateg.</td>
					<td>Įskaitytas svoris, kg</td>
					<td>Įmit. kateg.</td>
					<td>Gyv. svoris, kg</td>
					<td>Sv. skirtumas</td>
				</tr>

				@foreach ($sellerAnimals as $animal)
					<tr height="40px">
						<td>{{ ++$loop->index }}</td>
						<td>{{ $animal['agent_name'] }}</td>
						<td>{{ $animal['specialLetter']}}-{{$animal['animal_id'] }}</td>
						<td>{{ App\Animal::trimUntilFirstLetter($animal['sex']) }}</td>
						<td>{{ $animal['inclination'] }}</td>
						<td>{{ $animal['includable_weight'] }}</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				@endforeach
				<tr height="40px">
					<td colspan="10" class="table-footer-td">
						<span class="table-footer">VISO: {{ $totalAnimals }}</span>
						<span class="table-footer">Iš jų buliai iki 24mėn.- {{ $youngBullCount }}</span>
						<span class="table-footer">virš 24mėn.- {{ $oldBullCount }}</span>
						<span class="table-footer">karvių - {{ $cowCount }}</span>
						<span class="table-footer">telyčių - {{ $heiferCount }}</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 bottom">
			Vairuotojas <strong>{{ Auth::user()->name }}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Skerdyklos gyvulių priėmėjas...........................................................................
		</div>
	</div>
@endsection
