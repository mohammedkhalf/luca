<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";

    protected $fillable = [
        'order_id','creation_date','dropshipper_id','dropshipper_name','dropshipper_mobile',
            'consumer_name','consumer_mobile_1','consumer_mobile_2','region','area','address','store_name','shipping_company',
            'shipping_cost','order_total_sales','order_total_net','status','user_id','dropshipper_email',
    ];
}
