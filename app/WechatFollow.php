<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatFollow extends Model
{
    protected $table = 'wechat_follow';

    protected $guarded = [];

    public function addresses(){
        return $this->hasMany('App\WechatAddress','openid','openid');
    }
}
