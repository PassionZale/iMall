<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatCart extends Model
{
    protected $table = 'wechat_cart';

    protected $guarded = [];

    public function hasOneCommodity()
    {
        return $this->hasOne('App\ProductCommodity', 'id', 'commodity_id');
    }

}
