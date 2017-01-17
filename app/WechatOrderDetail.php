<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatOrderDetail extends Model
{
    protected $table = 'wechat_order_details';

    protected $guarded = [];

    public function order(){
        return $this->belongsTo('App\WechatOrder','order_id','id');
    }

}
