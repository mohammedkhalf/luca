<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = "shippings";

    protected $fillable = ['region_id','region','area','area_en','area_ar','shipping_company','created_at'];
}
