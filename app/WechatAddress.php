<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatAddress extends Model
{
    protected $table = 'wechat_address';

    protected $guarded = [];

    public function follow(){
        return $this->belongsTo('App\WechatFollow','openid','openid');
    }

}
