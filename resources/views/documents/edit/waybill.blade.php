@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editWaybillByCarcass') }}</h3>
					</div>
					<form action="{{ url('documents/waybill/'.$documentId) }}" enctype="multipart/form-data" method="post" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}

                        <div class='box-body'>
                            <div class="form-group">
								<h2>{{ trans('adminlte_lang::message.animalInvoiceNumber')}} <sup>*</sup></h2>
								<input type="number" class="form-control" name="animalInvoiceNumber"/>
			                </div>
                        </div>

						<div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.seller') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.nameSurnameOrTitle') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_name'] }}' class="form-control" name="seller_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.adress') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_address'] }}' class="form-control" name="seller_address"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.phoneNumber') }} <sup>*</sup></label>

                                <div class="input-group">
                                    <span class="input-group-addon">+3706</span>
                                    <input type="number" value='{{ $documentInfo['seller_phone'] }}' step='1' min='0' onKeyPress="if(this.value.length==7) return false;" class="form-control" name="seller_phone"/>
                                </div>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.faxNumber') }} <sup>*</sup></label>
								<input type="number" value='{{ $documentInfo['seller_fax'] }}' class="form-control" name="seller_fax"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.email') }} <sup>*</sup></label>
								<input type="email" value='{{ $documentInfo['seller_email'] }}' class="form-control" name="seller_email"/>
			                </div>
						</div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.driver') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.nameSurname') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_name'] }}' class="form-control" name="user_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.autoNumbers') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_plate'] }}' class="form-control" name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.trailerPlates') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_trailer_plates'] }}' class="form-control" name="user_trailer_plates"/>
                                <p class="help-block">Formatas: AA000</p>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.travelPaperNo') }} <sup>*</sup></label>
								<input type="number" value='{{ $documentInfo['doc__k_v']['user_travel_paper_number'] }}' class="form-control" name="user_travel_paper_number"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.package') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.preciseLoadAdress') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_pick_up_address'] }}' class="form-control" name="seller_pick_up_address"/>
			                </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.loadInDate') }} <sup>*</sup></label>
        								<input type="text" value='{{ Carbon\Carbon::now()->toDateString() }}' class="form-control datepicker" name="loadInDate"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.loadInTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value='{{ Carbon\Carbon::now()->format('H') }}' class="form-control" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="loadInHour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value='{{ Carbon\Carbon::now()->format('i') }}' class="form-control" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="loadInMinutes" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.loadOutDate') }} <sup>*</sup></label>
        								<input type="text" value='{{ Carbon\Carbon::now()->addMinutes(30)->toDateString() }}' class="form-control datepicker" name="loadOutDate"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.loadOutTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value='{{ Carbon\Carbon::now()->addMinutes(30)->format('H') }}' class="form-control" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="loadOutHour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value='{{ Carbon\Carbon::now()->addMinutes(30)->format('i') }}' class="form-control" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="loadOutMinutes" value='00'/>
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
