<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $connection = 'PostalCodesDB';
    public    $timestamps = false;
    protected $table      = 'postal_codes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'postal_code',
        'area',
        'prefecture',
        'city',
        'town',
        'area_kana',
        'prefecture_kana',
        'city_kana',
        'town_kana',
        'area_kanji',
        'prefecture_kanji',
        'city_kanji',
        'town_kanji',
    ];
}
