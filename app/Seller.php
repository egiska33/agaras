<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Services\CaptureService;
use App\Http\Services\CaptchaService;
use App\Http\Services\AddressService;
use App\Http\Services\SpecialVatService;
use App\Http\Services\VatService;
use Carbon\Carbon;

class Seller extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'address',
        'pick_up_address',
        'pvm_code',
        'pass_number',
        'pass_issued_date',
        'phone',
        'pvm_rate',
        'fooder',
        'prosperity_evaluation',
        'possesion',
        'passport_number',
        'passport_created_at',
        'seller_representative',
        'post_code',

        'email',
        'fax',
        'farmer_pass_number',
        'bank',
        'bank_pay_account_number',

        'has_exemption',

        'travel_start_time',
        'travel_start_date',
        'travel_duration',
    ];

    protected $appends = ['fooder_other'];

    protected $dates = ['pass_issued_date'];

    const FOODS = ['Šienas', 'Šienainis', 'Silosas', 'Šiaudai', 'Koncentratai', 'Šakniavaisiai', 'Išspaudos'];

    public function animals()
    {
        return $this->hasMany('App\Animal');
    }

    public function setFooderAttribute($value)
    {
        $this->attributes['fooder'] = implode(', ', $value);
    }

    public function getFooderAttribute($value)
    {
        return explode(', ', $value);
    }

    public function getFooderOtherAttribute()
    {
        foreach ($this->fooder as $food) {
            if(!in_array($food, self::FOODS)) {
                return $food;
                break;
            }
        }

        return '';
    }

    /**
     * Find seller by code
     *
     * @param  string  $value
     * @return int or boolean
     */
    public static function sellerExists($code)
    {
        $exists = Seller::where('code', $code)->first();

        if(is_null($exists)) {
            return false;
        }

        return true;
    }

    public static function getSellerId($code)
    {
        return Seller::where('code', $code)->value('id');
    }

    /**
     * Get vat rate by using services
     *
     * @param int $id Seller id
     * @return int Vat rate
     */
    public function getVatRateAndUpdate()
    {
        if(!empty($this->last_vat_check)) {
            $lastVatCheck = Carbon::parse($this->last_vat_check);

            if($lastVatCheck->diffInDays(Carbon::now()) < 1) {
                return ['info' => trans('adminlte_lang::message.updateNotNeeded')];
            }
        }

        $capture = new CaptureService();

        if(!$capture) {
            return ['danger' => trans('adminlte_lang::message.vmiVatServiceError')];
        }

        $captcha = new CaptchaService();

        $vat = new VatService($this, $capture->process(), $captcha->process());

        $resp = $vat->process();

        if($resp == false && is_bool($resp)) {
            $this->pvm_code = '0';
            $this->save();
            return ['danger' => trans('adminlte_lang::message.vmiResponseServiceError')];
        }

        if ($vat->getRequestType() == 'juridical' && isset($resp['hasExemption'])) {
            $this->has_exemption = $resp['hasExemption'];
        }

        $this->last_vat_check = Carbon::now();
        $this->pvm_code = $resp['vatCode'];
        $this->pvm_rate = $resp['rate'];
        $this->save();

        return ['success' => trans('adminlte_lang::message.vatRateServiceSuccess')];
    }

    /**
     * Get post code and update Seller object
     * @return array
     */
    public function getPostCodeAndUpdate()
    {
        $service = new AddressService($this);

        $postCode = $service->getPostCode();

        if (!$postCode) {
            return ['danger' => trans('adminlte_lang::message.addressServiceNotFound')];
        }

        $this->post_code = $postCode;
        $this->save();

        return ['success' => trans('adminlte_lang::message.addressServiceSuccess')];
    }

    /**
     * Get custom vat code and update Seller object
     * @return array
     */
    public function getCustomVatCode()
    {
        $vatCode = ((new SpecialVatService($this, (new CaptureService('get'))->process()))->process());

        if(!$vatCode) {
            return ['danger' => trans('adminlte_lang::message.vmiSpecialServiceError')];
        }

        $this->pvm_code = $vatCode;
        $this->save();

        return ['success' => trans('adminlte_lang::message.vmiSpecialServiceSuccess')];
    }
}
