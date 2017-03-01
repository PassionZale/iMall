<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatOrder extends Model
{
    protected $table = 'wechat_orders';

    protected $guarded = [];

    public function details(){
        return $this->hasMany('App\WechatOrderDetail','order_id','id');
    }

    public function follow(){
        return $this->belongsTo('App\WechatFollow','openid','openid');
    }
}
