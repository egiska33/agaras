@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.faq') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.faq') }}</h3>
					</div>
					<div class="box-body staticPage">
						<div>
							<b>
								Prisijungiau prie sistemos su savo prisijungimais,
								bet matau kito vairuotojo informaciją.
							</b>
							<p>
								Tikriausiai, prieš tai su įrenginių (planšete)
								dirbo kitas asmuo. Jums reikia išvalyti naršymo
								istoriją. Atlikite šiuos žingsnius:
							</p>
							<ol>
								<li>atsijunkite nuo sistemos.</li>
								<li>
									išvalykite naršymo istoriją (clear browsing history):
									3 vertikalūs brūkšniai dešinėje nuorodos > istorija >
									išvalyti naršymo istoriją > pasirinkite laikotarpį
									'Visa' > išvalyti istoriją
								</li>
								<li>prisijunkite prie sistemos.</li>
							</ol>
						</div>

						<div>
							<b>
								Gaunu pranešimą, kad "Toks gyvulys LTXXXXXXXXXXX
								jau egzistuoja".
							</b>
							<p>Tai reiškia, kad toks gyvulys administratoriaus
								duomenų bazėje jau egzistuoja. Tikėtina, kad
								suklydote vesdami gyvulio ID arba tokį gyvulį
								priėmė kitas vairuotojas iš kito tiekėjo. Sprendimas -
								pasižiūrėkite ar teisingai įvedėte gyvulio ID
								numerį. Jei suklydote vesdami ID - ištrinkite
								gyvulį ir pridėkite iš naujo. Jei įvedėte teisingą
								gyvulio ID., tai susisiekite su administratoriumi
								ir kartu ieškokite neatitikimo.
							</p>
						</div>

						<div>
							<b>Ką reiškia degantis burbuliukas šalia mano vardo?</b>
							<p>
								Burbuliukai informuoja apie sinchronizavimo statusą ir
								kiekviena spalva turi reikšmę. Iš viso yra 4 spalvos:
							</p>
							<ul class='cleanList'>
								<li>žalia - viskas sėkmingai sinchronizuota.</li>
								<li>oranžinė - vyksta sinchronizavimas.</li>
								<li>raudona - klaida vykdant sinchronizavimą.</li>
								<li>baltas - nėra interneto ryšio.</li>
							</ul>
							<p>Tai informacinio pobūdžio aspektas.</p>
						</div>

						<div>
							<b>Vadybininkas man pridėjo naują maršrutą, bet aš jo nematau.</b>
							<p>
								Visų pirmą, reikia, kad turėtumėte interneto ryšį.
								Tada reikia perkrauti puslapį, kad informacija
								atsinaujintų ir į Jūsų sistemą atkeliautų vadybininko
								sukurta maršrutas. Jei visos anksčiau minėtos
								sąlygos yra patenkintos, tai susisiekite su
								vadybininku ir pasitikslinkite ar jis tikrai
								pridėjo Jums maršrutą.
							</p>
						</div>

						<div>
							<b>Formuoti dokumentus lange nematau pardavėjo</b>
							<p>
								Reikia užpildyti trūkstamą informaciją apie pardavėją,
								kad jį matytumėte formuoti dokumentus pasirinkime ir
								galėtumėte tam pardavėjui suformuluoti dokumentus.
								Privaloma užpildyti laukus: mobilaus telefono nr.,
								pardavėjo atstovas, laikymo adresas.
							</p>
						</div>

						<div>
							<b>Kodėl nematau maršrutų?</b>
							<p>
								Tam reikia 2 dalykų: interneto ir tada perkrauti puslapį.
								Jei neatsivaizduoja, tai tikėtina, kad maršrutas Jums
								nebuvo sukurtas. Pasitikslinkite su vadybininku.
							</p>
						</div>

						<div>
							<b>Kur dingo mano sukurti tam tikro pardavėjo gyvuliai?</b>
							<p>Jei ištrinate pardavėją, tai kartu išsitrina ir visi pardavėjo gyvuliai.</p>
						</div>

						<div>
							<b>Dirbant atsiranda ir dingsta besisukantis burbuliukas. Ką jis daro?</b>
							<p>
								Besisukantis burbuliukas reiškia, kad vyksta sinchronizavimas.
								Atsiranda ir dingsta, todėl kad stringa interneto ryšis ir sistema
								vis atnaujina duomenis.
							</p>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
