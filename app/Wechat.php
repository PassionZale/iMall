<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wechat extends Model
{
    protected $table = 'wechat';

    protected $guarded = [];

    protected $hidden = [
        'token', 'app_id', 'app_secret', 'encodingaeskey'
    ];
}
