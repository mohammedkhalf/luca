<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Shipping;
use App\Repositories\BaseRepository;
use DB;
use Carbon\Carbon;


class ShippingsRepository extends BaseRepository
{
	 /**
     * Associated Repository Model.
     */
    const MODEL = Shipping::class;
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
            ->select([
                'shippings.id',
                'shippings.region',
                'shippings.area',
                'shippings.region_en',
                'shippings.area_en',
                'shippings.shipping_company',
                'shippings.created_at',
                'shippings.updated_at',
            ]);
    }

}