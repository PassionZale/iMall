<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPlate extends Model
{
    protected $table = 'product_plate';

    protected $guarded = [];

    public function commodities(){
        return $this->hasMany('App\ProductCommodity','plate_id');
    }
}
