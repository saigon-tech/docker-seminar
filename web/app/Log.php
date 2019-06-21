<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'PostalCodesDB';
    public    $timestamps = false;
    protected $table      = 'logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'time',
        'postal_code',
        'api',
    ];
}
