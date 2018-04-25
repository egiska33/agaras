@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.editSeller') }}
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="box box-primary">
                    <form action="{{ url('sellers/'.$seller->id) }}" method="POST">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('adminlte_lang::message.editSeller') }}</h3>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.sellerName') }} <sup>*</sup></label>
                                <input type="text" class="form-control" readonly='readonly' name="name"
                                       value="{{ $seller->name }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.sellerCode') }} <sup>*</sup></label>
                                <input type="text" class="form-control" readonly='readonly' name="code"
                                       value="{{ $seller->code }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.sellerAddress') }} <sup>*</sup></label>
                                <input type="text" class="form-control" readonly='readonly' name="address"
                                       value="{{ $seller->address }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.postCode') }} </label>
                                <input type="text" class="form-control" readonly='readonly' name="post_code"
                                       value="{{ $seller->post_code }}">
                            </div>
                            <div class="form-group">
                                <label>
                                    {{ trans('adminlte_lang::message.sellerRepresentative') }} <sup>*</sup>
                                </label>
                                <input type="text" class="form-control" name="seller_representative"
                                       value="{{ $seller->seller_representative }}">
                            </div>
                            <div class="form-group">
                                <label>
                                    {{ trans('adminlte_lang::message.sellerTakeAddress') }}
                                    <div class="checkbox inline">
                                        <label>
                                            <input type="checkbox" name="isSameAddress"
                                                   @if($seller->address == $seller->pick_up_address)checked="checked"@endif> {{ trans('adminlte_lang::message.sellerSameAddress') }}
                                        </label>
                                    </div>
                                </label>
                                <input type="text" class="form-control" name="pick_up_address"
                                       value="{{ $seller->pick_up_address }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.vatNumber') }}</label>
                                <input type="text" class="form-control" name="pvm_code" value="{{ $seller->pvm_code }}">
                            </div>
                            <div class="checkbox disabled">
                                <label>
                                    <input type="checkbox" class="disabled" disabled
                                           @if($seller->has_exemption) checked @endif> {{ trans('adminlte_lang::message.hasExemption')}}
                                </label>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.vatRate') }}</label>
                                <select name="pvm_rate" class="form-control">
                                    <option value="">-</option>
                                    <option value="0" @if( $seller->pvm_rate == '0') selected @endif>0</option>
                                    <option value="6" @if( $seller->pvm_rate == '6') selected @endif>6</option>
                                    <option value="21" @if( $seller->pvm_rate == '21') selected @endif>21</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.email') }}</label>
                                <input type="email" value="{{ $seller->email }}" class="form-control" name="email"/>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.farmerCertificateNumber') }}</label>
                                <input type="number" min='0' value="{{ $seller->farmer_pass_number }}"
                                       class="form-control" name="farmer_pass_number"/>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.sellerPhone') }} <sup>*</sup></label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        +3706
                                    </div>
                                    <input type="number" class="form-control" name="phone" value="{{ $seller->phone }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.bank') }}</label>
                                <input type="text" class="form-control" name="bank" value="{{ $seller->bank }}"/>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.bankAccount') }}</label>
                                <input type="text" value="{{ $seller->bank_pay_account_number }}" class="form-control"
                                       name="bank_pay_account_number"/>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.faxNumber') }} </label>
                                <input type="number" class="form-control" value="{{ $seller->fax }}" name="fax"/>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.passportNumber') }} </label>
                                <input type="number" class="form-control" name="passport_number"
                                       value="{{ $seller->passport_number }}">
                            </div>
                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.passportCreatedAt') }} </label>
                                <input type="text" class="datepicker form-control" name="pass_issued_date"
                                       value="{{ $seller->pass_issued_date }}">
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('adminlte_lang::message.travel') }}</h3>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.leaveDate') }} <sup>*</sup></label>

                                        <input type="text" value="{{ Carbon\Carbon::now()->toDateString() }}" class="form-control datepicker leaveDateInput" name="travel_start_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.leaveTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value="{{ Carbon\Carbon::now()->addMinutes(30)->format('H') }}" class="form-control leaveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value="{{ Carbon\Carbon::now()->addMinutes(30)->format('i') }}" class="form-control leaveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_start_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ trans('adminlte_lang::message.predictedTravelTime') }} <sup>*</sup></label>
                                <input type="number" value="" class="form-control predictedTravelTimeInput" min='1' max='9' step='1'  onKeyUp="if(this.value > 9) this.value = 9;" onKeyPress="if(this.value.length==2) return false;" name="travel_duration"/>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.predictedArrivalDate') }} <sup>*</sup></label>
                                        <input type="text"  value="" class="form-control datepicker arriveDateInput" name="travel_arrive_date"/>
                                    </div>
                                </div>

                                <div class='col-xs-12 col-sm-6'>
                                    <div class="form-group">
                                        <label>{{ trans('adminlte_lang::message.predictedArrivalTime') }} <sup>*</sup></label>

                                        <div class="input-group">
                                            <input type="number" value="" class="form-control arriveHourInput" min='0' max='23' step='1'  onKeyUp="if(this.value > 23) this.value = 23;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_hour"/>
                                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">:</span>
                                            <input type="number" value="" class="form-control arriveMinuteInput" min='0' max='59' step='1' onKeyUp="if(this.value > 59) this.value = 59;" onKeyPress="if(this.value.length==2) return false;" name="travel_arrive_minute" value='00'/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <!-- /.box-body -->
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ trans('adminlte_lang::message.animalsConditions') }}</h3>
                        </div>
                        <div class="box-body">
                            <h4>{{ trans('adminlte_lang::message.fooderInFarm') }}</h4>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Šienas"
                                                  @if((is_array($seller->fooder) && in_array('Šienas', $seller->fooder)) || (is_array(old('fooder')) && in_array('Šienas', old('fooder')))) checked @endif >Šienas</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Šienainis"
                                                  @if((is_array($seller->fooder) && in_array('Šienainis', $seller->fooder)) || (is_array(old('fooder')) && in_array('Šienainis', old('fooder')))) checked @endif>Šienainis</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Silosas"
                                                  @if((is_array($seller->fooder) && in_array('Silosas', $seller->fooder)) || (is_array(old('fooder')) && in_array('Silosas', old('fooder')))) checked @endif>Silosas</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Šiaudai"
                                                  @if((is_array($seller->fooder) && in_array('Šiaudai', $seller->fooder)) || (is_array(old('fooder')) && in_array('Šiaudai', old('fooder')))) checked @endif>Šiaudai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Koncentratai"
                                                  @if((is_array($seller->fooder) && in_array('Koncentratai', $seller->fooder)) || (is_array(old('fooder')) && in_array('Koncentratai', old('fooder')))) checked @endif>Koncentratai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Šakniavaisiai"
                                                  @if((is_array($seller->fooder) && in_array('Šakniavaisiai', $seller->fooder)) || (is_array(old('fooder')) && in_array('Šakniavaisiai', old('fooder')))) checked @endif>Šakniavaisiai</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="fooder[]" value="Išspaudos"
                                                  @if((is_array($seller->fooder) && in_array('Išspaudos', $seller->fooder)) || (is_array(old('fooder')) && in_array('Išspaudos', old('fooder')))) checked @endif>Išspaudos</label>
                                </div>
                                <div class="checkbox">
                                    <label><input id="other-checkbox" type="checkbox" name="fooder[]" value="Kita"
                                                  @if(!empty($seller->fooder_other)) checked @endif >Kita
                                        (Įrašyti)</label><input type="text" class="form-control other-input" name=""
                                                                value="{{ $seller->fooder_other }}">
                                </div>
                            </div>
                            <h4>{{ trans('adminlte_lang::message.prosperityEvaluation') }}</h4>
                            <div class="form-group">
                                <div class="radio">
                                    <label><input type="radio" name="prosperity_evaluation" value="Gerai"
                                                  @if($seller->prosperity_evaluation == 'Gerai' || old('prosperity_evaluation') == 'Gerai') checked @endif>Gerai</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="prosperity_evaluation" value="Patenkinamai"
                                                  @if($seller->prosperity_evaluation == 'Patenkinamai' || old('prosperity_evaluation') == 'Patenkinamai') checked @endif>Patenkinamai</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="prosperity_evaluation" value="Blogai"
                                                  @if($seller->prosperity_evaluation == 'Blogai' || old('prosperity_evaluation') == 'Blogai') checked @endif>Blogai</label>
                                </div>
                            </div>
                            <h4>{{ trans('adminlte_lang::message.animalPOG') }}</h4>
                            <div class="form-group">
                                <div class="radio">
                                    <label><input type="radio" name="possesion" value="Laikomi palaidi"
                                                  @if($seller->possesion == 'Laikomi palaidi' || old('possesion') == 'Laikomi palaidi') checked @endif>Laikomi
                                        palaidi</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="possesion" value="Laikomi pririšti garduose"
                                                  @if($seller->possesion == 'Laikomi pririšti garduose' || old('possesion') == 'Laikomi pririšti garduose'))
                                                  checked @endif>Laikomi pririšti garduose</label>
                                </div>
                            </div>
                            @if($seller->animals()->count() > 0)
                                <h4>{{ trans('adminlte_lang::message.animalsInPots') }}</h4>
                                @foreach($seller->animals()->get() as $animal)
                                    <div class="pot-box">
                                        <h5 class="with-border">{{ $animal->animal_id}}</h5>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><input type="radio" name="pot-{{ $animal->id }}" value="1"
                                                                  @if($animal->pot == 1 || old('pot-'.$animal->id) == 1) checked @endif>1
                                                        gardas</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <label><input type="radio" name="pot-{{ $animal->id }}" value="2"
                                                                  @if($animal->pot == 2 || old('pot-'.$animal->id) == 2) checked @endif>2
                                                        gardas</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <label><input type="radio" name="pot-{{ $animal->id }}" value="3"
                                                                  @if($animal->pot == 3 || old('pot-'.$animal->id) == 3) checked @endif>3
                                                        gardas</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <label><input type="radio" name="pot-{{ $animal->id }}" value="4"
                                                                  @if($animal->pot == 4 || old('pot-'.$animal->id) == 4) checked @endif>4
                                                        gardas</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="box-footer">
                            <button type="submit"
                                    class="btn btn-block btn-primary">{{ trans('adminlte_lang::message.save') }}</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>
@endsection

