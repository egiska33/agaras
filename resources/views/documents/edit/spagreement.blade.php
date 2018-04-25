@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editSPAgreement') }}</h3>
					</div>
					<form action="{{ url('documents/spagreement/'.$documentId) }}" enctype="multipart/form-data" method="post" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}

						<div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.buyerRepresentative') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.nameSurname') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['user_name'] }}' name="user_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.position') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['user_position'] }}' name="user_position"/>
			                </div>
                        </div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.seller') }}</h2>

			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.companyNameSurname') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_name'] }}' name="seller_name"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.personOrCompanyCode') }} <sup>*</sup></label>
								<input type="number" class="form-control" value='{{ $documentInfo['seller_code'] }}' disabled/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.adress') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_address'] }}' name="seller_address"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.phoneNumber') }} <sup>*</sup></label>

                                <div class="input-group">
                                    <span class="input-group-addon">+3706</span>
                                    <input type="number" step='1' min='0' value='{{ $documentInfo['seller_phone'] }}' onKeyPress="if(this.value.length==7) return false;" class="form-control" name="seller_phone"/>
                                </div>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.faxNumber') }} <sup>*</sup></label>
								<input type="number" value='{{ $documentInfo['seller_fax'] }}' class="form-control" name="seller_fax"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.pvmNumber') }}</label>
								<input type="text" value='{{ $documentInfo['seller_pvm_code'] }}' class="form-control" name="seller_pvm_code"/>
			                </div>

                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
        								<label>{{ trans('adminlte_lang::message.passSeriesAndNumber') }} </label>
        								<input type="number" value='{{ $documentInfo['seller_pass_series_number'] }}' class="form-control"  name="seller_pass_series_number"/>
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
								<label>{{ trans('adminlte_lang::message.bank') }}</label>
								<input type="text" value='{{ $documentInfo['seller_bank'] }}' class="form-control" name="seller_bank"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.bankAccount') }}</label>
								<input type="text" value='{{ $documentInfo['seller_bank_pay_account_number'] }}' class="form-control" name="seller_bank_pay_account_number"/>
			                </div>
						</div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.animalPrices') }}</h2>

                            <div class='row'>
                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.bulls') }} </label>

                                        <div class="input-group">
                                            <input type="number" value='{{ $documentInfo['doc__p_p']['bull_price'] }}' step='0.01' min='0' class="form-control" name="bull_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.heifers') }} </label>

                                        <div class="input-group">
                                            <input type="number" value='{{ $documentInfo['doc__p_p']['heifer_price'] }}' step='0.01' min='0' class="form-control" name="heifer_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.cows') }} </label>

                                        <div class="input-group">
                                            <input type="number" value='{{ $documentInfo['doc__p_p']['cow_price'] }}' step='0.01' min='0' class="form-control" name="cow_price"/>
                                            <span class="input-group-addon">&euro;/kg</span>
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
