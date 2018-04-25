@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editWaybillByWeight') }}</h3>
					</div>
					<form action="{{ url('documents/animalsWaybill/'.$documentId) }}" enctype="multipart/form-data" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}

						<div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.seller') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.sellerName') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_name'] }}' name="seller_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.personOrCompanyCode') }} <sup>*</sup></label>
								<input type="number" class="form-control" disabled value='{{ $documentInfo['seller_code'] }}'/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.livingAdressFull') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_address'] }}' name="seller_address"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.sellerRepresentative') }}</h2>
                            <h2>{{ trans('adminlte_lang::message.animals') }}</h2>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.specie') }} <sup>*</sup></label>
                                <input type="text" value='{{ $documentInfo['doc__v_g']['sex'] }}' class="form-control" name="sex"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.heldPlaceNumber') }} <sup>*</sup></label>
        								<input type="number"value='{{ $documentInfo['doc__v_g']['held_place_number'] }}' class="form-control" name="held_place_number"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.bandNumber') }} <sup>*</sup></label>
        								<input type="text" value='{{ $documentInfo['doc__v_g']['herd_number'] }}' class="form-control" name="herd_number"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.heldPlaceAdress') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['doc__v_g']['held_adress'] }}' class="form-control" name="held_adress"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.travel') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.animalDriverApprovalNo') }} <sup>*</sup></label>
								<input type="number" value='{{ $documentInfo['doc__v_g']['vet_pass_number'] }}' class="form-control" name="vet_pass_number"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.autoNumbers') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['user_plate'] }}' name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.trailerPlates') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['user_trailer_plates'] }}' name="user_trailer_plates"/>
                                <p class="help-block">Formatas: AA000</p>
			                </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.leaveDate') }} <sup>*</sup></label>

        								<input type="text" value='{{ $documentInfo['travel_start_date'] }}' class="form-control datepicker leaveDateInput" name="travel_start_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.leaveTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value='{{ $documentInfo['travel_start_hour'] }}' class="form-control leaveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value='{{ $documentInfo['travel_start_minute'] }}' class="form-control leaveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.predictedTravelTime') }} <sup>*</sup></label>
                                <input type="number" value='{{ $documentInfo['doc__v_g']['travel_duration'] }}' class="form-control predictedTravelTimeInput" name="travel_duration"/>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.predictedArrivalDate') }} <sup>*</sup></label>
        								<input type="text"  value='{{ $documentInfo['travel_arrive_date'] }}' class="form-control datepicker arriveDateInput" name="travel_arrive_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.predictedArrivalTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value='{{ $documentInfo['travel_arrive_hour'] }}' class="form-control arriveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value='{{ $documentInfo['travel_arrive_minute'] }}' class="form-control arriveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.save') }}</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('custom_js')
	<script type="text/javascript">
		$(document).ready(function() {
			$('.leaveDateInput, .leaveHourInput, .leaveMinuteInput, .predictedTravelTimeInput').on('change keyup keydown click', function()
			{
				var startDate = $(".leaveDateInput").val();
                var startHour = $(".leaveHourInput").val();
                var startMinute = $(".leaveMinuteInput").val();

                var startDateObject = new Date(startDate);
                startDateObject.setHours(startHour);
                startDateObject.setMinutes(startMinute);

                var travelHours = $(".predictedTravelTimeInput").val();

                startDateObject.setHours(startDateObject.getHours() + Number(travelHours));

                var arrivalMonth = startDateObject.getMonth() + 1;
                if(arrivalMonth < 10) arrivalMonth = "0"+arrivalMonth;

                var arrivalDay = startDateObject.getDate();
                if(arrivalDay < 10) arrivalDay = "0"+arrivalDay;

                var arrivalDate = startDateObject.getFullYear()+"-"+arrivalMonth+"-"+arrivalDay;

                $(".arriveMinuteInput").val(startMinute);

                $(".arriveDateInput").val(arrivalDate);
                $(".arriveHourInput").val(startDateObject.getHours());
			});
		});
	</script>
@endsection
