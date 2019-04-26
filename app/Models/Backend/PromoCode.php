<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'promoCode','quantity','type','discount','edate'
    ];

    public static function findByCode($code)
    {
        return self::where('promoCode', $code)->first();
    }

    public function discount($total, $isFixed)
    { 
        if ($isFixed) {
            return round($this->discount);
        }else{
            return round(($this->discount / 100) * $total);

        }
    }
}
