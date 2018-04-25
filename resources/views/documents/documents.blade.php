@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.documents') }}
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-12">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-book" aria-hidden="true"></i> {{ trans('adminlte_lang::message.documents') }}</h3>
                    </div>
                    <div class="box-body">
                      <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-xs-12 col-sm-5 col-md-6 box-button-group">
                                @role('driver')
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#formDocumentsModal'><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.create_docs')}}</a>
                                @endrole
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target='#applicationModal'><i class='fa fa-plus'></i> {{ trans('adminlte_lang::message.create_application')}}</a>
                                @if(File::exists(\App\File::GLOBAL_FILE_PATH))
                                    <a class="btn btn-primary btn-sm" href="{{ url(\App\File::GLOBAL_FILE_PATH) }}">{{ trans('adminlte_lang::message.pricelist') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 date-filter">
                                <a href="#" class="margin-bottom" data-toggle="modal" data-target="#modal-default">{{ trans('adminlte_lang::message.chooseDriverAndDate') }}</a>
                                @if(!empty(Request::get('date')) || !empty(Request::get('driver')))
                                    <a href="{{ url('documents') }}" class="text-red">{{ trans('adminlte_lang::message.clear')}}</a>
                                    @if( strtotime(Request::get('date')) !== false)
                                        <p>
                                            <strong>Pasirinkta data:</strong> {{ \Carbon\Carbon::parse(Request::get('date'))->format('Y-m-d') }}
                                        </p>
                                    @endif
                                    @if( Request::get('driver') && Request::get('driver') != '')
                                        <p>
                                            <strong>Pasirinktas vairuotojas:</strong> {{ Request::get('driver') }}
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable table-striped table-responsive-row" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th>Pardavėjas</th>
                                            <th>Vairuotojas</th>
                                            <th>Kodas</th>
                                            <th>VG Važtaraštis (pagal gyvą svorį)</th>
                                            <th>Sąskaita faktūra</th>
                                            <th>PI Kvitas</th>
                                            <th>PP Sutartis</th>
                                            <th>Krovinio važtaraštis (pagal skerdieną)</th>
                                            <th>Veiksmai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allDocuments as $document)
                                            <form method='POST' action='{{url('documents/print')}}'>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="row-id" value="{{ $document->id }}">
                                                <tr role="row">
                                                    <td class='forceHiddenDesktop'>Pardavėjas</td>
                                                    <td>{{ $document['seller_name'] }}</td>

                                                    <td class='forceHiddenDesktop'>Vairuotojas</td>
                                                    <td>{{ $document->user_name }}</td>

                                                    <td class='forceHiddenDesktop'>Kodas</td>
                                                    <td>{{ $document['seller_code'] }}</td>

                                                    <td class='forceHiddenDesktop'>VG Važtaraštis (pagal gyvą svorį)</td>
                                                    <td class="checkbox-col">
                                                        @if(!empty($document->vg_id))
                                                            <a href="{{ url('documents/animalsWaybill/'.$document->vg_id.'') }}">Žiūrėti</a><span>
                                                             / </span><a href="{{ url('documents/animalsWaybill/'.$document->vg_id.'/edit') }}">Redaguoti</a>  <br />
                                                            <input type="checkbox" name="print_vg">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class='forceHiddenDesktop'>Sąskaita faktūra</td>
                                                    <td class="checkbox-col">
                                                        @if(!empty($document->sf_id))
                                                            @if(!empty($document->seller_pvm_code))
                                                                <a href="{{ url('documents/vatInvoice/'.$document->sf_id.'') }}">Žiūrėti sąskaitą faktūrą.</a>
                                                            @else
                                                                <a href="{{ url('documents/invoice/'.$document->sf_id.'') }}">Žiūrėti sąskaitą faktūrą.</a>
                                                            @endif

                                                             <span> / </span><a href="{{ url('documents/vatInvoice/'.$document->sf_id.'/edit') }}">Redaguoti</a> <br />
                                                            <input type="checkbox" name="print_sf" />
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class='forceHiddenDesktop'>PI Kvitas</td>
                                                    <td class="checkbox-col">
                                                        @if(!empty($document->pi_id))
                                                            <a href="{{ url('documents/payoutCheck/'.$document->pi_id.'') }}">Žiūrėti</a><span> / </span><a href="{{ url('documents/payoutCheck/'.$document->pi_id.'/edit') }}">Redaguoti</a> <br />
                                                            <input type="checkbox" name="print_pi">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class='forceHiddenDesktop'>PP Sutartis</td>
                                                    <td class="checkbox-col">
                                                        @if(!empty($document->pp_id))
                                                            <a href="{{ url('documents/spagreement/'.$document->pp_id.'') }}">Žiūrėti</a><span> <span> / </span></span><a href="{{ url('documents/spagreement/'.$document->pp_id.'/edit') }}">Redaguoti</a> <br />
                                                            <input type="checkbox" name="print_pp">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class='forceHiddenDesktop'>Krovinio važtaraštis (pagal skerdieną)</td>
                                                    <td class="checkbox-col">
                                                        @if(!empty($document->kv_id))
                                                            <a href="{{ url('documents/waybill/'.$document->kv_id.'') }}">Žiūrėti</a><span> / </span><a href="{{ url('documents/waybill/'.$document->kv_id.'/edit') }}">Redaguoti</a><br />
                                                            <input type="checkbox" name="print_kv">
                                                        @else
                                                            <span>-</span>
                                                        @endif
                                                    </td>

                                                    <td class='forceHiddenDesktop'>Veiksmai</td>
                                                    <td>
                                                        <input type='submit' value='Spausdinti visus' name='printAll' class="btn btn-sm btn-primary"/><button type='submit' name='printSelected' class="btn printSelectedBtn btn-sm btn-primary">Spausdinti pasirinktus</button>
                                                        <a href="{{ url('documents/'.$document->id.'') }}" class="btn btn-sm btn-danger button-delete">Ištrinti eilutę</a>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $allDocuments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>

    <div class="modal fade in" id="formDocumentsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <h4 class="modal-title">{{ trans('adminlte_lang::message.selectSellerForDocuments') }}</h4>
                </div>

                <form action="{{ route('formDocuments') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.shouldPIBeGenerated') }} <sup>*</sup></label>

                                <div class='input-group'>
                                    <label>
                                        <input type="radio" value='1' name="create_pi"/>
                                        <span>Taip</span>
                                    </label>
                                </div>

                                <div class='input-group'>
                                    <label>
                                        <input type="radio" value='0' checked='checked' name="create_pi"/>
                                        <span>Ne</span>
                                    </label>
                                </div>
                            </div>

                            <label>{{ trans('adminlte_lang::message.selectSeller') }}</label>

                            @foreach ($newAnimals as $newAnimal)
                                <br />
                                <label>
                                    <input type='radio' name='sellerId' value="{{ $newAnimal['seller']['id'] }}" /> <span>{{ $newAnimal['seller']['name'] }}  {{ $newAnimal['seller']['code'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>

                        <button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.format') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade in" id="applicationModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    <h4 class="modal-title">{{ trans('adminlte_lang::message.formApplication') }}</h4>
                </div>

                <form action="{{ route('application') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ trans('adminlte_lang::message.selectSeller') }}</label>

                            @foreach ($newAnimals as $newAnimal)
                                <br />
                                <label>
                                    <input type='checkbox' class='sellerIdInput' name='sellerId[]' value="{{ $newAnimal['seller']['id'] }}" /> <span>{{ $newAnimal['seller']['name'] }}  {{ $newAnimal['seller']['code'] }}</span>
                                    <input type="text" style='display: none;' placeholder='Pardavėjo agentas' name='agent_{{ $newAnimal['seller']['id'] }}' class="form-control" name="seller_agent"/>
                                </label>
                            @endforeach

                            <div class='row'>
                                <div class='col-xs-12'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.buyerName') }} <sup>*</sup></label>
                                        <input type="text" class="form-control" name="buyer_name"/>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.animalsDeliveredFrom') }} <sup>*</sup></label>
                                        <textarea style='resize: vertical; min-height: 120px;' type="text" class="form-control" name="buyer_animals_from"></textarea>
                                    </div>

                                    <label>{{ trans('adminlte_lang::message.animalsDeliveredDateTime') }} <sup>*</sup></label>

                                    <div class='row'>
                                        <div class='col-xs-12 col-sm-6'>
                                            <div class="form-group">
                                                <input
                                                    value='{{ $now->toDateString() }}'
                                                    type="text"
                                                    class="form-control datepicker arriveDateInput"
                                                    name="buyer_animals_deliver_date"/>
                                            </div>
                                        </div>

                                        <div class='col-xs-12 col-sm-6'>
                                            <input
                                                value='{{ $now->hour }}'
                                                type="number"
                                                class="form-control arriveHourInput"
                                                min='0' max='23' step='1'
                                                onKeyUp="if(this.value > 23) this.value = 23;"
                                                onKeyPress="if(this.value.length==2) return false;"
                                                name="buyer_animals_deliver_hour"
                                                placeholder="valanda"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>

                        <button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.format') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <form id="delete_record" class="hidden" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
    <div class="modal fade in" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">{{ trans('adminlte_lang::message.concreteDate') }}</h4>
          </div>
          <form action="{{ url('documents') }}" method="GET">
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ trans('adminlte_lang::message.chooseDriver') }}</label>
                    <select name="driver" class="form-control">
                        <option value="">Visi</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->name }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{ trans('adminlte_lang::message.concreteDate') }}</label>
                    <input class="datepicker form-control" type="text" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.close') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('adminlte_lang::message.doFiltering') }}</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('custom-css')
    .sellerIdInput:checked ~ input{
        display: block !important;
    }

    @media all and (min-width: 991px){
        .forceHiddenDesktop{
            display: none;
        }
    }

    @media all and (max-width: 991px) {
        .dataTable{
            width: 100%;
        }

        .printSelectedBtn{
            white-space: pre-wrap;
        }

        .dataTable tbody tr{
            display: flex;
            flex-wrap: wrap;
        }

        .dataTable tbody td:nth-child(odd)
        {
            text-align: right !important;
        }

        .dataTable tbody td{
            display: inline-block !important;
            padding: 8px !important;
            width: 50% !important;
            text-overflow: unset;
        }
    }
@endsection
