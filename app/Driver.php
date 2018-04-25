<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'plate', 'position', 'trailer_plates',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routes()
    {
        return $this->hasMany('App\Route', 'user_id');
    }

    public function serials()
    {
        return $this->hasOne('App\DocumentsSerials', 'user_id');
    }

    public function setPlateAttribute($value)
    {
        $this->attributes['plate'] = strtoupper($value);
    }

}
