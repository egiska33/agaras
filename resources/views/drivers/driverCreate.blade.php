@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.createDriver') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.createDriver') }}</h3>
					</div>
					<form action="{{ url('/drivers') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.email') }} *</label>
		                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
		                    </div>
		                    <div class="form-group">
		                    	<label>{{ trans('adminlte_lang::message.password') }} *</label>
		                        <input type="password" class="form-control" name="password" />
		                    </div>
		                    <div class="form-group">
		                    	<label>{{ trans('adminlte_lang::message.retypepassword') }} *</label>
		                        <input type="password" class="form-control" name="password_confirmation" />
		                    </div>
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverName') }} *</label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" />
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPlate') }} *</label>
								<input type="text" class="form-control" name="plate" value="{{ old('plate') }}" />
								<p class="help-block">Formatas: AAA000</p>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.trailerPlates') }}</label>
								<input type="text" class="form-control" name="trailer_plates" value="{{ old('trailer_plates') }}">
								<p class="help-block">Formatas: AA000</p>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPosition') }} *</label>
								<input type="text" class="form-control" name="position" value="{{ old('position') }}" />
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPhone') }} *</label>
								<input type="text" class="form-control" name="phone" value="{{ old('phone') }}" />
			                </div>
						</div>
						<!-- /.box-body -->
						<div class="box-header with-border">
							<h3 class="box-title">{{ trans('adminlte_lang::message.documentsSerials') }}</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.vatInvoiceSerial') }} *</label>
									<input type="text" class="form-control" name="vat_invoice_serial" value="{{ old('vat_invoice_serial') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.vatInvoiceNumber') }} *</label>
									<input type="text" class="form-control" name="vat_invoice_number" value="{{ old('vat_invoice_number') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.invoiceSerial') }} *</label>
									<input type="text" class="form-control" name="invoice_serial" value="{{ old('invoice_serial') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.invoiceNumber') }} *</label>
									<input type="text" class="form-control" name="invoice_number" value="{{ old('invoice_number') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.payoutCheckSerial') }} *</label>
									<input type="text" class="form-control" name="payout_check_serial" value="{{ old('payout_check_serial') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.payoutCheckNumber') }} *</label>
									<input type="text" class="form-control" name="payout_check_number" value="{{ old('payout_check_number') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.spAgreementSerial') }} *</label>
									<input type="text" class="form-control" name="sp_agreement_serial" value="{{ old('sp_agreement_serial') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.spAgreementNumber') }} *</label>
									<input type="text" class="form-control" name="sp_agreement_number" value="{{ old('sp_agreement_number') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.waybillSerial') }} *</label>
									<input type="text" class="form-control" name="waybill_serial" value="{{ old('waybill_serial') }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.waybillNumber') }} *</label>
									<input type="text" class="form-control" name="waybill_number" value="{{ old('waybill_number') }}">
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
