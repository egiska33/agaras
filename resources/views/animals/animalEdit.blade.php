@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editAnimal') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editAnimal') }}</h3>
					</div>
					<form action="{{ url('animals/'. $animal->id) }}" method="POST">
						{{ method_field('PUT') }}
						{{ csrf_field() }}
						<input type="hidden" name="seller_id" value="{{ $animal->seller_id }}">
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalId') }}</label>
									<input type="text" class="form-control" name="animal_id" value="{{ $animal->animal_id }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.herdNumber') }}</label>
									<input type="text" class="form-control" name="herd_number" value="{{ $animal->herd_number }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalPassportId') }}</label>
									<input type="text" class="form-control"name="passport_id" value="{{ $animal->passport_id }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
								   <label>{{ trans('adminlte_lang::message.animalSex') }}</label>
								   <select class='form-control specieInput' name='sex'>
									   <option data-price-percentage='5' @if( $animal->sex == 'Bulius iki 24mėn.') selected @endif value="{{ trans('adminlte_lang::message.bullYoungerThan24months') }}">{{ trans('adminlte_lang::message.bullYoungerThan24months') }}</option>
									   <option data-price-percentage='5' @if( $animal->sex == 'Bulius virš 24mėn.') selected @endif value="{{ trans('adminlte_lang::message.bullOlderThan24months') }}">{{ trans('adminlte_lang::message.bullOlderThan24months') }}</option>
									   <option data-price-percentage='5' @if( $animal->sex == 'Kastratas') selected @endif value="{{ trans('adminlte_lang::message.animalCastrated') }}">{{ trans('adminlte_lang::message.animalCastrated') }}</option>
									   <option data-price-percentage='6' @if( $animal->sex == 'Karvė') selected @endif value="{{ trans('adminlte_lang::message.cow') }}">{{ trans('adminlte_lang::message.cow') }}</option>
									   <option data-price-percentage='5' @if( $animal->sex == 'Telyčia') selected @endif value="{{ trans('adminlte_lang::message.heifer') }}">{{ trans('adminlte_lang::message.heifer') }}</option>
									   <option data-price-percentage='5' @if( $animal->sex == 'Telyčaitė') selected @endif value="{{ trans('adminlte_lang::message.youngHeifer') }}">{{ trans('adminlte_lang::message.youngHeifer') }}</option>
								   </select>
							   </div>
						   </div>

						   <div class="col-xs-12 col-md-6">
							   <div class="form-group">
								   <label>{{ trans('adminlte_lang::message.animalBreed') }}</label>
								   <select class="form-control" name="breed">
									   <option value="Kiti" @if( $breed == 'Kiti') selected @endif>Kiti</option>
									   <option value="Angusai" @if( $breed == 'Angusai') selected @endif>Angusai</option>
									   <option value="Aubrakai" @if( $breed == 'Aubrakai') selected @endif>Aubrakai</option>
									   <option value="Herefordai" @if( $breed == 'Herefordai') selected @endif>Herefordai</option>
									   <option value="Juodmargiai x mėsinių veislių" @if( $breed == 'Juodmargiai x mėsinių veislių') selected @endif>Lietuvos juodmargiai x mėsiniai</option>
									   <option value="Lietuvos juodmargiai" @if( $breed == 'Lietuvos juodmargiai') selected @endif>Lietuvos juodmargiai</option>
									   <option value="Žalieji x mėsinių veislių" @if( $breed == 'Žalieji x mėsinių veislių') selected @endif>Lietuvos žalieji x mėsiniai</option>
									   <option value="Lietuvos žalieji" @if( $breed == 'Lietuvos žalieji') selected @endif>Lietuvos žalieji</option>
									   <option value="Limuzinai" @if($breed == 'Limuzinai') selected @endif>Limuzinai</option>
									   <option value="Mėsiniai x mėsinių veislių" @if( $breed == 'Mėsiniai x mėsinių veislių') selected @endif>Mėsiniai x mėsiniai</option>
									   <option value="Simentalai" @if( $breed == 'Simentalai') selected @endif>Simentalai</option>
									   <option value="Šarolė" @if( $breed == 'Šarolė') selected @endif>Šarolė</option>
									   <option value="Žalmargiai holšteinai" @if( $breed == 'Žalmargiai holšteinai') selected @endif>Žalmargiai holšteinai</option>
									   <option value="Vietiniai baltnugariai" @if( $breed == 'Vietiniai baltnugariai') selected @endif>Vietiniai baltnugariai</option>
									   <option value="Vokietijos juodmargiai" @if( $breed == 'Vokietijos juodmargiai') selected @endif>Vokietijos juodmargiai</option>
									   <option value="Holšteinai" @if( $breed == 'Holšteinai') selected @endif>Holšteinai</option>
									   <option value="Vokietijos žalmargiai" @if( $breed == 'Vokietijos žalmargiai') selected @endif>Vokietijos žalmargiai</option>

								   </select>
							   </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalCOB') }}</label>
									<select class="form-control" name="cob">
										<option value="Lietuva" @if( $animal->cob == 'Lietuva') selected @endif>Lietuva</option>
										<option value="Airija" @if( $animal->cob == 'Airija') selected @endif>Airija</option>
										<option value="Austrija" @if( $animal->cob == 'Austrija') selected @endif>Austrija</option>
										<option value="Belgija" @if( $animal->cob == 'Belgija') selected @endif>Belgija</option>
										<option value="Bulgarija" @if( $animal->cob == 'Bulgarija') selected @endif>Bulgarija</option>
										<option value="Čekija" @if( $animal->cob == 'Čekija') selected @endif>Čekija</option>
										<option value="Danija" @if( $animal->cob == 'Danija') selected @endif>Danija</option>
										<option value="Estija" @if( $animal->cob == 'Estija') selected @endif>Estija</option>
										<option value="Graikija" @if( $animal->cob == 'Graikija') selected @endif>Graikija</option>
										<option value="Ispanija" @if( $animal->cob == 'Ispanija') selected @endif>Ispanija</option>
										<option value="Italija" @if( $animal->cob == 'Italija') selected @endif>Italija</option>
										<option value="Jungtinė Karalystė" @if( $animal->cob == 'Jungtinė Karalystė') selected @endif>Jungtinė Karalystė</option>
										<option value="Kipras" @if( $animal->cob == 'Kipras') selected @endif>Kipras</option>
										<option value="Kroatija" @if( $animal->cob == 'Kroatija') selected @endif>Kroatija</option>
										<option value="Latvija" @if( $animal->cob == 'Latvija') selected @endif>Latvija</option>
										<option value="Lenkija" @if( $animal->cob == 'Lenkija') selected @endif>Lenkija</option>
										<option value="Liuksemburgas" @if( $animal->cob == 'Liuksemburgas') selected @endif>Liuksemburgas</option>
										<option value="Malta" @if( $animal->cob == 'Malta') selected @endif>Malta</option>
										<option value="Nyderlandai" @if( $animal->cob == 'Nyderlandai') selected @endif>Nyderlandai</option>
										<option value="Portugalija" @if( $animal->cob == 'Portugalija') selected @endif>Portugalija</option>
										<option value="Prancūzija" @if( $animal->cob == 'Prancūzija') selected @endif>Prancūzija</option>
										<option value="Rumunija" @if( $animal->cob == 'Rumunija') selected @endif>Rumunija</option>
										<option value="Slovakija" @if( $animal->cob == 'Slovakija') selected @endif>Slovakija</option>
										<option value="Slovėnija" @if( $animal->cob == 'Slovėnija') selected @endif>Slovėnija</option>
										<option value="Suomija" @if( $animal->cob == 'Suomija') selected @endif>Suomija</option>
										<option value="Švedija" @if( $animal->cob == 'Švedija') selected @endif>Švedija</option>
										<option value="Vengrija" @if( $animal->cob == 'Vengrija') selected @endif>Vengrija</option>
										<option value="Vokietija" @if( $animal->cob == 'Vokietija') selected @endif>Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalDOB') }}</label>
									<input type="text" class="form-control datepicker" name="dob" value="{{ $animal->dob }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalInclination') }}</label>
									<select class="form-control" name="inclination">
										<option value="-">-</option>
										<option value="0" @if($animal->inclination == "0") selected @endif>Pagal skerdieną</option>
										<option value="1" @if($animal->inclination == "1") selected @endif>1</option>
										<option value="2" @if($animal->inclination == "2") selected @endif>2</option>
										<option value="3" @if($animal->inclination == "3") selected @endif>3</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalAge') }}</label>
									<input type="text" class="form-control" name="age" value="{{ \Carbon\Carbon::parse($animal->dob)->diffInMonths(\Carbon\Carbon::now()) }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalRealWeight') }}</label>
									<input type="number" class="form-control realWeightInput" name="real_weight" value="{{ $animal->real_weight }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('adminlte_lang::message.deviation') }}</label>
                                    <input type="number" class="form-control deviationInput" step='0.01' name='deviation' >
                                </div>
                            </div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalLegibleWeight') }}</label>
									<input type="number" class="form-control includableWeightInput" name="includable_weight" value="{{ $animal->includable_weight }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalPOG') }}</label>
									<select class="form-control" name="pog">
										<option value="Lietuva" @if( $animal->pog == 'Lietuva') selected @endif>Lietuva</option>
										<option value="Airija" @if( $animal->pog == 'Airija') selected @endif>Airija</option>
										<option value="Austrija" @if( $animal->pog == 'Austrija') selected @endif>Austrija</option>
										<option value="Belgija" @if( $animal->pog == 'Belgija') selected @endif>Belgija</option>
										<option value="Bulgarija" @if( $animal->pog == 'Bulgarija') selected @endif>Bulgarija</option>
										<option value="Čekija" @if( $animal->pog == 'Čekija') selected @endif>Čekija</option>
										<option value="Danija" @if( $animal->pog == 'Danija') selected @endif>Danija</option>
										<option value="Estija" @if( $animal->pog == 'Estija') selected @endif>Estija</option>
										<option value="Graikija" @if( $animal->pog == 'Graikija') selected @endif>Graikija</option>
										<option value="Ispanija" @if( $animal->pog == 'Ispanija') selected @endif>Ispanija</option>
										<option value="Italija" @if( $animal->pog == 'Italija') selected @endif>Italija</option>
										<option value="Jungtinė Karalystė" @if( $animal->pog == 'Jungtinė Karalystė') selected @endif>Jungtinė Karalystė</option>
										<option value="Kipras" @if( $animal->pog == 'Kipras') selected @endif>Kipras</option>
										<option value="Kroatija" @if( $animal->pog == 'Kroatija') selected @endif>Kroatija</option>
										<option value="Latvija" @if( $animal->pog == 'Latvija') selected @endif>Latvija</option>
										<option value="Lenkija" @if( $animal->pog == 'Lenkija') selected @endif>Lenkija</option>
										<option value="Liuksemburgas" @if( $animal->pog == 'Liuksemburgas') selected @endif>Liuksemburgas</option>
										<option value="Malta" @if( $animal->pog == 'Malta') selected @endif>Malta</option>
										<option value="Nyderlandai" @if( $animal->pog == 'Nyderlandai') selected @endif>Nyderlandai</option>
										<option value="Portugalija" @if( $animal->pog == 'Portugalija') selected @endif>Portugalija</option>
										<option value="Prancūzija" @if( $animal->pog == 'Prancūzija') selected @endif>Prancūzija</option>
										<option value="Rumunija" @if( $animal->pog == 'Rumunija') selected @endif>Rumunija</option>
										<option value="Slovakija" @if( $animal->pog == 'Slovakija') selected @endif>Slovakija</option>
										<option value="Slovėnija" @if( $animal->pog == 'Slovėnija') selected @endif>Slovėnija</option>
										<option value="Suomija" @if( $animal->pog == 'Suomija') selected @endif>Suomija</option>
										<option value="Švedija" @if( $animal->pog == 'Švedija') selected @endif>Švedija</option>
										<option value="Vengrija" @if( $animal->pog == 'Vengrija') selected @endif>Vengrija</option>
										<option value="Vokietija" @if( $animal->pog == 'Vokietija') selected @endif>Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Eur/kg</label>
									<input type="number" class="form-control" name="price_kg" value="{{ $animal->price_kg }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerName') }}</label>
									<input type="text" class="form-control" name="seller_name" value="{{ $animal->seller->name }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerCode') }}</label>
									<input type="text" class="form-control" name="code" value="{{ $animal->seller->code }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerAddress') }}</label>
									<input type="text" class="form-control" name="seller_address" value="{{ $animal->seller->address }}">
				                </div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.save') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
@endsection

@section('custom_js')
	<script type="text/javascript">
		function updateIncludableWeight()
		{
			var deviationMultiplier = 1 - (Number($('.deviationInput').val()) / 100);

			$(".includableWeightInput").val(Math.round(Number($(".realWeightInput").val()) * deviationMultiplier));
		}

		function updateDeviation()
		{
			$('.deviationInput').val(Number($(this).find(":selected").data('price-percentage')));
			updateIncludableWeight();
		}

		$(document).ready(function() {
			$('.specieInput').on('change', updateDeviation);
			$(".realWeightInput").on('keyup keydown change', updateIncludableWeight);
			$(".deviationInput").on('keyup keydown change', updateIncludableWeight);

			if($('.specieInput').val() == 'Karvė') $(".deviationInput").val(6);
			else $(".deviationInput").val(5);
		});
	</script>
@endsection
