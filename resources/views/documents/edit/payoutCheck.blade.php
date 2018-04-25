@extends('adminlte::layouts.app-offline')

@section('htmlheader_title')

@endsection

@section('main-content')
    <div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.editPayoutCheck') }}</h3>
					</div>
					<form action="{{ url('documents/payoutCheck/'.$documentId) }}" enctype="multipart/form-data" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{ method_field('PUT') }}

						<div class="box-body">
                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.payFor') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['doc__p_i']['paid_for'] }}' name="paid_for"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.invoiceNumber') }} <sup>*</sup></label>
								<input type="number" class="form-control" value='{{ $documentInfo['doc__p_i']['invoice_number'] }}' name="invoice_number"/>
			                </div>

                            <label>{{ trans('adminlte_lang::message.paidPrice') }}</label>

                            <div class='row'>
                                <div class='col-xs-6 col-sm-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" step='1' min='0' value='{{ explode('.', $documentInfo['doc__p_i']['paid_sum'])[0] }}' class="form-control" name="paid_sum_eur"/>
                                            <span class="input-group-addon">&euro;</span>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-xs-6 col-sm-4'>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" onKeyPress="if(this.value.length==2) return false;" value='{{ $paidCents }}' step='1' min='0' max='99' class="form-control" name="paid_sum_ct"/>
                                            <span class="input-group-addon">ct</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.paidDriverNameSurname') }}<sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['user_name'] }}' name="user_name"/>
			                </div>
						</div>

                        <div class="box-body">
                            <h2>{{ trans('adminlte_lang::message.seller') }}</h2>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.personCode') }} <sup>*</sup></label>
								<input type="number" class="form-control" value='{{ $documentInfo['seller_code'] }}' disabled/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.passNumber') }} <sup>*</sup></label>
								<input type="number" class="form-control" value='{{ $documentInfo['seller_pass_series_number'] }}' name="seller_pass_series_number"/>
			                </div>

                            <div class="form-group">
								<label>{{ trans('adminlte_lang::message.livingAdress') }} <sup>*</sup></label>
								<input type="text" class="form-control" value='{{ $documentInfo['seller_address'] }}' name="seller_address"/>
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
