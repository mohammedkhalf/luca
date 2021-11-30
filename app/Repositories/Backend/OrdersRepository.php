<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Repositories\BaseRepository;


class OrdersRepository extends BaseRepository
{
	 /**
     * Associated Repository Model.
     */
    const MODEL = Order::class;
    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
    ];

    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('order_statuses', 'order_statuses.order_id', '=', 'orders.id')
            ->select([
                'orders.id',
                'orders.dropshipper_id',
                'orders.consumer_name',
                'orders.consumer_mobile_1',
                'orders.region',
                'orders.area',
                'orders.address',
                'orders.store_name',
                'orders.shipping_cost',
                'orders.order_total_sales',
                'orders.order_total_net',
                'orders.creation_date',
                'order_statuses.status',
            ]);
    }

}