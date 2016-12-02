<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    protected $guarded = [];

    public function commodities(){
        return $this->hasMany('App\ProductCommodity','category_id');
    }

}
