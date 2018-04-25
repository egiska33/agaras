@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.updateDriver') }}
@endsection

@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-md-offset-3">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ trans('adminlte_lang::message.updateDriver') }}</h3>
					</div>
					<form action="{{ url('drivers/'.$driver->id) }}" method="POST">
						{{ method_field('PUT') }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="box-body">
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.email') }} <sup>*</sup></label>
		                        <input type="email" class="form-control" name="email" value="{{ $driver->email }}"/>
		                    </div>
							<div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverName') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="name" value="{{ $driver->name }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPlate') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="plate" value="{{ $driver->plate }}">
								<p class="help-block">Formatas: AAA000</p>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.trailerPlates') }}</label>
								<input type="text" class="form-control" name="trailer_plates" value="{{ $driver->trailer_plates }}">
								<p class="help-block">Formatas: AA000</p>
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPosition') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="position" value="{{ $driver->position }}">
			                </div>
			                <div class="form-group">
								<label>{{ trans('adminlte_lang::message.driverPhone') }} <sup>*</sup></label>
								<input type="text" class="form-control" name="phone" value="{{ $driver->phone }}">
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
									<input type="text" class="form-control" name="vat_invoice_serial" value="{{ $driver->serials->vat_invoice_serial }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.vatInvoiceNumber') }} *</label>
									<input type="text" class="form-control" name="vat_invoice_number" value="{{ $driver->serials->vat_invoice_number }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.invoiceSerial') }} *</label>
									<input type="text" class="form-control" name="invoice_serial" value="{{ $driver->serials->invoice_serial }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.invoiceNumber') }} *</label>
									<input type="text" class="form-control" name="invoice_number" value="{{ $driver->serials->invoice_number }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.payoutCheckSerial') }} *</label>
									<input type="text" class="form-control" name="payout_check_serial" value="{{ $driver->serials->payout_check_serial }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.payoutCheckNumber') }} *</label>
									<input type="text" class="form-control" name="payout_check_number" value="{{ $driver->serials->payout_check_number }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.spAgreementSerial') }} *</label>
									<input type="text" class="form-control" name="sp_agreement_serial" value="{{ $driver->serials->sp_agreement_serial }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.spAgreementNumber') }} *</label>
									<input type="text" class="form-control" name="sp_agreement_number" value="{{ $driver->serials->sp_agreement_number }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.waybillSerial') }} *</label>
									<input type="text" class="form-control" name="waybill_serial" value="{{ $driver->serials->waybill_serial }}">
				                </div>
							</div>

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>{{ trans('adminlte_lang::message.waybillNumber') }} *</label>
									<input type="text" class="form-control" name="waybill_number" value="{{ $driver->serials->waybill_number }}">
				                </div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.update') }}</button>
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
