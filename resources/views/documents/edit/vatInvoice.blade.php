@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editSF') }}</h3>
					</div>
					<form action="{{ url('documents/vatInvoice/'.$documentId) }}" enctype="multipart/form-data" method="post" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}

						<div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.seller') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.nameSurname') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_name'] }}' name="seller_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.position') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_position']}}' name="seller_position"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.personOrCompanyCode') }} <sup>*</sup></label>
								<input type="number" class="form-control" value='{{ $documentInfo['seller_code'] }}' disabled/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.pvmPayerCode') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_pvm_code'] }}' name="seller_pvm_code"/>
			                </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
        								<label>{{ trans('adminlte_lang::message.passSeriesAndNumber') }} </label>
        								<input type="number" value='{{ $documentInfo['seller_pass_series_number'] }}' class="form-control" name="seller_pass_series_number"/>
        			                </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
        								<label>{{ trans('adminlte_lang::message.passIssuedDate') }} </label>
        								<input type="text" value='{{ $documentInfo['seller_pass_issued_date'] }}' class="form-control datepicker" name="seller_pass_issued_date"/>
        			                </div>
                                </div>
                            </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.bank') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_bank'] }}' class="form-control" name="seller_bank"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.bankPayAccountNumber') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_bank_pay_account_number'] }}' class="form-control" name="seller_bank_pay_account_number"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.farmerCertificateNumber') }} <sup>*</sup></label>
								<input type="number" min='0' value='{{ $documentInfo['doc__s_f']['farmer_pass_number'] }}' class="form-control" name="farmer_pass_number"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverNameSurname') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_name'] }}' class="form-control" name="user_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.autoNumbers') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_plate'] }}' class="form-control" name="user_plate"/>
                                <p class="help-block">Formatas: AAA000</p>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.loadPlace') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['seller_pick_up_address'] }}' class="form-control" name="seller_pick_up_address"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.loadDate') }} <sup>*</sup></label>
								<input
									type="text"
									value="@if( !empty($documentInfo['travel_start_datetime'])){{ $documentInfo['travel_start_datetime'] }}@else{{ Carbon\Carbon::now()->format('Y-m-d') }}@endif"
									class="form-control datepicker"
									name="travel_start_datetime"
								/>
			                </div>

                            <h3>{{ trans('adminlte_lang::message.legalPersonOrIndividual') }}</h3>

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
                            <h2>{{ trans('adminlte_lang::message.buyer') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverNameSurname') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_name'] }}' class="form-control" name="user_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.position') }} <sup>*</sup></label>
								<input type="text" value='{{ $documentInfo['user_position'] }}' class="form-control" name="user_position"/>
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
