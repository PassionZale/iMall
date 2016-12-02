<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTopic extends Model
{
    protected $table = 'product_topic';

    protected $guarded = [];

    public function commodities(){
        return $this->hasMany('App\ProductCommodity','topic_id','id');
    }

}
