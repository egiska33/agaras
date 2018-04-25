@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createAnimal') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createAnimal') }}</h3>
					</div>
					<form action="{{ url('animals') }}" method="POST">
						{{ csrf_field() }}
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalId') }}</label>
									<input type="text" class="form-control" name="animal_id" value="{{ old('animal_id') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalPassportId') }}</label>
									<input type="text" class="form-control" name="passport_id" value="{{ old('passport_id') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.herdNumber') }}</label>
									<input type="text" class="form-control" name="herd_number" value="{{ old('herd_number') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class='form-group'>
									<label>{{ trans('adminlte_lang::message.animalSpecie') }}</label>

									<select class='form-control specieInput' name='specie'>
										<option data-price-percentage='5' @if( old('specie') == 'Bulius iki 24mėn.') selected @endif value="{{ trans('adminlte_lang::message.bullYoungerThan24months') }}">{{ trans('adminlte_lang::message.bullYoungerThan24months') }}</option>
										<option data-price-percentage='5' @if( old('specie') == 'Bulius virš 24mėn') selected @endif value="{{ trans('adminlte_lang::message.bullOlderThan24months') }}">{{ trans('adminlte_lang::message.bullOlderThan24months') }}</option>
										<option data-price-percentage='5' @if( old('specie') == 'Kastratas') selected @endif value="{{ trans('adminlte_lang::message.animalCastrated') }}">{{ trans('adminlte_lang::message.animalCastrated') }}</option>
										<option data-price-percentage='6' @if( old('specie') == 'Karvė') selected @endif value="{{ trans('adminlte_lang::message.cow') }}">{{ trans('adminlte_lang::message.cow') }}</option>
										<option data-price-percentage='5' @if( old('specie') == 'Telyčia') selected @endif value="{{ trans('adminlte_lang::message.heifer') }}">{{ trans('adminlte_lang::message.heifer') }}</option>
										<option data-price-percentage='5' @if( old('specie') == 'Telyčaitė') selected @endif value="{{ trans('adminlte_lang::message.youngHeifer') }}">{{ trans('adminlte_lang::message.youngHeifer') }}</option>
									</select>
								</div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalBreed') }}</label>
									<select class="form-control" name="breed">
										<option value="Kiti" @if( old('breed') == 'Kiti') selected @endif>Kiti</option>
										<option value="Angusai" @if( old('breed') == 'Angusai') selected @endif>Angusai</option>
										<option value="Aubrakai" @if( old('breed') == 'Aubrakai') selected @endif>Aubrakai</option>
										<option value="Herefordai" @if( old('breed') == 'Herefordai') selected @endif>Herefordai</option>
										<option value="Juodmargiai x mėsinių veislių" @if( old('breed') == 'Lietuvos juodmargiai x mėsiniai') selected @endif>Lietuvos juodmargiai x mėsiniai</option>
										<option value="Lietuvos juodmargiai" @if( old('breed') == 'Lietuvos juodmargiai') selected @endif>Lietuvos juodmargiai</option>
										<option value="Žalieji x mėsinių veislių" @if( old('breed') == 'Lietuvos žalieji x mėsiniai') selected @endif>Lietuvos žalieji x mėsiniai</option>
										<option value="Lietuvos žalieji" @if( old('breed') == 'Lietuvos žalieji') selected @endif>Lietuvos žalieji</option>
										<option value="Limuzinai" @if( old('breed') == 'Limuzinai') selected @endif>Limuzinai</option>
										<option value="Mėsiniai x mėsinių veislių" @if( old('breed') == 'Mėsiniai x mėsiniai') selected @endif>Mėsiniai x mėsiniai</option>
										<option value="Simentalai" @if( old('breed') == 'Simentalai') selected @endif>Simentalai</option>
										<option value="Šarolė" @if( old('breed') == 'Šarolė') selected @endif>Šarolė</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalCOB') }}</label>
									<select class="form-control" name="cob">
										<option value="Lietuva" @if( old('cob') == 'Lietuva') checked @endif>Lietuva</option>
										<option value="Airija" @if( old('cob') == 'Airija') checked @endif>Airija</option>
										<option value="Austrija" @if( old('cob') == 'Austrija') checked @endif>Austrija</option>
										<option value="Belgija" @if( old('cob') == 'Belgija') checked @endif>Belgija</option>
										<option value="Bulgarija" @if( old('cob') == 'Bulgarija') checked @endif>Bulgarija</option>
										<option value="Čekija" @if( old('cob') == 'Čekija') checked @endif>Čekija</option>
										<option value="Danija" @if( old('cob') == 'Danija') checked @endif>Danija</option>
										<option value="Estija" @if( old('cob') == 'Estija') checked @endif>Estija</option>
										<option value="Graikija" @if( old('cob') == 'Graikija') checked @endif>Graikija</option>
										<option value="Ispanija" @if( old('cob') == 'Ispanija') checked @endif>Ispanija</option>
										<option value="Italija" @if( old('cob') == 'Italija') checked @endif>Italija</option>
										<option value="Jungtinė Karalystė" @if( old('cob') == 'Jungtinė Karalystė') checked @endif>Jungtinė Karalystė</option>
										<option value="Kipras" @if( old('cob') == 'Kipras') checked @endif>Kipras</option>
										<option value="Kroatija" @if( old('cob') == 'Kroatija') checked @endif>Kroatija</option>
										<option value="Latvija" @if( old('cob') == 'Latvija') checked @endif>Latvija</option>
										<option value="Lenkija" @if( old('cob') == 'Lenkija') checked @endif>Lenkija</option>
										<option value="Liuksemburgas" @if( old('cob') == 'Liuksemburgas') checked @endif>Liuksemburgas</option>
										<option value="Malta" @if( old('cob') == 'Malta') checked @endif>Malta</option>
										<option value="Nyderlandai" @if( old('cob') == 'Nyderlandai') checked @endif>Nyderlandai</option>
										<option value="Portugalija" @if( old('cob') == 'Portugalija') checked @endif>Portugalija</option>
										<option value="Prancūzija" @if( old('cob') == 'Prancūzija') checked @endif>Prancūzija</option>
										<option value="Rumunija" @if( old('cob') == 'Rumunija') checked @endif>Rumunija</option>
										<option value="Slovakija" @if( old('cob') == 'Slovakija') checked @endif>Slovakija</option>
										<option value="Slovėnija" @if( old('cob') == 'Slovėnija') checked @endif>Slovėnija</option>
										<option value="Suomija" @if( old('cob') == 'Suomija') checked @endif>Suomija</option>
										<option value="Švedija" @if( old('cob') == 'Švedija') checked @endif>Švedija</option>
										<option value="Vengrija" @if( old('cob') == 'Vengrija') checked @endif>Vengrija</option>
										<option value="Vokietija" @if( old('cob') == 'Vokietija') checked @endif>Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalDOB') }}</label>
									<input type="text" class="form-control datepicker" data-date-end-date="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" name="dob" value="{{ old('dob') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalInclination') }}</label>
									<select class="form-control" name="inclination">
										<option value="-">{{ trans('adminlte_lang::message.chooseCategory') }}</option>
										<option value="0" @if(old('inclination') == "0") selected @endif>Pagal skerdieną</option>
										<option value="1" @if(old('inclination') == "1") selected @endif>1</option>
										<option value="2" @if(old('inclination') == "2") selected @endif>2</option>
										<option value="3" @if(old('inclination') == "3") selected @endif>3</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalAge') }}</label>
									<input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalRealWeight') }}</label>
									<input type="number" class="form-control realWeightInput" name="real_weight" value="{{ old('real_weight') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('adminlte_lang::message.deviation') }}</label>
                                    <input type="number" class="form-control deviationInput" step='0.01' name='deviation' value="{{ old('deviation') }}" >
                                </div>
                            </div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalLegibleWeight') }}</label>
									<input type="number" class="form-control includableWeightInput" name="includable_weight" value="{{ old('includable_weight') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.animalPOG') }}</label>
									<select class="form-control" name="pog">
										<option value="Lietuva" @if( old('pog') == 'Lietuva') checked @endif>Lietuva</option>
										<option value="Airija" @if( old('pog') == 'Airija') checked @endif>Airija</option>
										<option value="Austrija" @if( old('pog') == 'Austrija') checked @endif>Austrija</option>
										<option value="Belgija" @if( old('pog') == 'Belgija') checked @endif>Belgija</option>
										<option value="Bulgarija" @if( old('pog') == 'Bulgarija') checked @endif>Bulgarija</option>
										<option value="Čekija" @if( old('pog') == 'Čekija') checked @endif>Čekija</option>
										<option value="Danija" @if( old('pog') == 'Danija') checked @endif>Danija</option>
										<option value="Estija" @if( old('pog') == 'Estija') checked @endif>Estija</option>
										<option value="Graikija" @if( old('pog') == 'Graikija') checked @endif>Graikija</option>
										<option value="Ispanija" @if( old('pog') == 'Ispanija') checked @endif>Ispanija</option>
										<option value="Italija" @if( old('pog') == 'Italija') checked @endif>Italija</option>
										<option value="Jungtinė Karalystė" @if( old('pog') == 'Jungtinė Karalystė') checked @endif>Jungtinė Karalystė</option>
										<option value="Kipras" @if( old('pog') == 'Kipras') checked @endif>Kipras</option>
										<option value="Kroatija" @if( old('pog') == 'Kroatija') checked @endif>Kroatija</option>
										<option value="Latvija" @if( old('pog') == 'Latvija') checked @endif>Latvija</option>
										<option value="Lenkija" @if( old('pog') == 'Lenkija') checked @endif>Lenkija</option>
										<option value="Liuksemburgas" @if( old('pog') == 'Liuksemburgas') checked @endif>Liuksemburgas</option>
										<option value="Malta" @if( old('pog') == 'Malta') checked @endif>Malta</option>
										<option value="Nyderlandai" @if( old('pog') == 'Nyderlandai') checked @endif>Nyderlandai</option>
										<option value="Portugalija" @if( old('pog') == 'Portugalija') checked @endif>Portugalija</option>
										<option value="Prancūzija" @if( old('pog') == 'Prancūzija') checked @endif>Prancūzija</option>
										<option value="Rumunija" @if( old('pog') == 'Rumunija') checked @endif>Rumunija</option>
										<option value="Slovakija" @if( old('pog') == 'Slovakija') checked @endif>Slovakija</option>
										<option value="Slovėnija" @if( old('pog') == 'Slovėnija') checked @endif>Slovėnija</option>
										<option value="Suomija" @if( old('pog') == 'Suomija') checked @endif>Suomija</option>
										<option value="Švedija" @if( old('pog') == 'Švedija') checked @endif>Švedija</option>
										<option value="Vengrija" @if( old('pog') == 'Vengrija') checked @endif>Vengrija</option>
										<option value="Vokietija" @if( old('pog') == 'Vokietija') checked @endif>Vokietija</option>
									</select>
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>Eur/kg</label>
									<input type="number" class="form-control" name="price_kg" value="{{ old('price_kg') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerName') }}</label>
									<input type="text" class="form-control" name="seller_name" value="{{ old('seller_name') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerCode') }}</label>
									<input type="text" class="form-control" name="code" value="{{ old('code') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
				                <div class="form-group">
									<label>{{ trans('adminlte_lang::message.sellerAddress') }}</label>
									<input type="text" class="form-control" name="seller_address" value="{{ old('seller_address') }}">
				                </div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.create') }}</button>
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
		});
	</script>
@endsection
