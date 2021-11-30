<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    /**
     * The database table used by the model.
     *
     */
    protected $table = 'order_lines';

    /**
     * Mass Assignable fields of model
     * @var array
     */
    protected $fillable = ['order_id','product_id','product_name','line_id','variation','selling_price_gross','regular_price',
    'order_item_type','creation_date','qty','customer_id','sku'];

    /**
     * Default values for model fields
     * @var array
     */
    protected $attributes = [

    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Constructor of Model
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
