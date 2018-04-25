<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
    	'seller_id', 
        'animal_id', 
        'passport_id', 
        'sex', 
        'dob', 
        'cob', 
        'pog', 
        'inclination', 
        'real_weight', 
        'includable_weight', 
        'price_kg', 
        'breed', 
        'created_by',
        'herd_number',
    ];

    /**
     * Mutators
     */

    const BREEDS = [
        'Angusai' => 'Angusai',
        'Aubrakai' => 'Aubrakai',
        'Herefordai' => 'Herefordai',
        'Juodmargiai x mėsinių veislių' => 'Lietuvos juodmargiai x mėsiniai',
        'Lietuvos juodmargiai x mėsiniai' => 'Lietuvos juodmargiai x mėsiniai',
        'Lietuvos juodmargiai' => 'Lietuvos juodmargiai',
        'Žalieji x mėsinių veislių' => 'Lietuvos žalieji x mėsiniai',
        'Lietuvos žalieji x mėsiniai' => 'Lietuvos žalieji x mėsiniai',
        'Lietuvos žalieji' => 'Lietuvos žalieji',
        'Limuzinai' => 'Limuzinai',
        'Mėsiniai x mėsinių veislių' => 'Mėsiniai x mėsiniai',
        'Mėsiniai x mėsiniai' => 'Mėsiniai x mėsiniai',
        'Simentalai' => 'Simentalai',
        'Šarolė' => 'Šarolė',
        'Žalmargiai holšteinai' => 'Žalmargiai holšteinai',
        'Vietiniai baltnugariai' => 'Vietiniai baltnugariai',
        'Vokietijos juodmargiai' => 'Vokietijos juodmargiai',
        'Holšteinai' => 'Holšteinai',
        'Vokietijos žalmargiai' => 'Vokietijos žalmargiai'
    ];

    public function setPriceKgAttribute($value)
    {
        if(!empty($value)) {
            $this->attributes['price_kg'] = str_replace(',', '.', $value);
        } else {
            $this->attributes['price_kg'] = NULL;
        }
    }

    public function setBreedAttribute($value)
    {
        $value = trim($value);

        if (array_key_exists($value, self::BREEDS)) {
            $this->attributes['breed'] = self::BREEDS[$value];
        } else {
            $this->attributes['breed'] = 'Kiti';
        }
    }

    /**
     * Relations
     */

    public function seller()
    {
    	return $this->belongsTo('App\Seller');
    }

    public function document()
    {
        return $this->belongsTo('App\DocsPivot', 'docs_id');
    }

    /**
     * Check if animal is from Lithuania and prepare code for queries and populations
     * @param  string $id
     * @return string
     */
    public static function checkAnimalId($id)
    {
    	if(preg_match('/[A-Za-z]/', $id[0]) && preg_match('/[A-Za-z]/', $id[1])) {
    		return $id;
    	}

    	if(strlen($id) == 8) {
    		return 'LT0000' . $id;
    	}

    	$stringLength = 14;
    	$string = 'LT';

    	for($i = 0; $i < $stringLength - strlen($id) - strlen($string); $i+1) {
    		$string .= '0';
    	}

    	return $string .= $id;
    }

    public static function trimUntilFirstLetter($string)
    {
        if (strlen($string) == 0) {
            return '';
        }
        $stringArray = explode(' ', $string);
        $result = '';
        foreach ($stringArray as $word) {
            $result .= ucfirst($word[0]);
        }

        return $result;
    }
}
