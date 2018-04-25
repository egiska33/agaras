<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentsSerials extends Model
{
    protected $table = 'documents_serials';

    protected $fillable = [
        'user_id',
        'vat_invoice_serial',
        'vat_invoice_number',
        'invoice_serial',
        'invoice_number',
        'payout_check_serial',
        'payout_check_number',
        'sp_agreement_serial',
        'sp_agreement_number',
        'waybill_serial',
        'waybill_number',
    ];

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
}
