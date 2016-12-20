<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCommodity extends Model
{
    protected $table = 'product_commodity';

    protected $guarded = [];

    public function topic(){
        return $this->belongsTo('App\ProductTopic','topic_id');
    }

    public function plate(){
        return $this->belongsTo('App\ProductPlate','plate_id');
    }
    public function category(){
        return $this->belongsTo('App\ProductCategory','category_id');
    }

    public function cart(){
        return $this->hasOne('App\WechatCart','id','commodity_id');
    }

}
