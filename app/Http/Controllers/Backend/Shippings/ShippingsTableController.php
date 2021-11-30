<?php

namespace App\Http\Controllers\Backend\Shippings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Http\Requests\Backend\Shipping\ManageShippingRequest;
use App\Http\Requests\Backend\Shipping\CreateShippingRequest;
use App\Http\Requests\Backend\Shipping\StoreShippingRequest;
use App\Http\Requests\Backend\Shipping\EditShippingRequest;
use App\Http\Requests\Backend\Shipping\UpdateShippingRequest;
use App\Http\Requests\Backend\Shipping\DeleteShippingRequest;
use App\Repositories\Backend\ShippingsRepository;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Shipping;

class ShippingsTableController extends Controller
{
    protected $repository;
    /**
     * @param \App\Repositories\Backend\FaqsRepository $faqs
     */
    public function __construct(ShippingsRepository $repository)
    {
        $this->repository = $repository;
    }

     public function __invoke(ManageShippingRequest $request)
    {
            return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['id'])
            ->addColumn('region', function ($shipping) {
                return $shipping->region;
            })
            ->addColumn('area', function ($shipping) {
                return $shipping->area;
            })
            ->addColumn('region_en', function ($shipping) {
                return $shipping->region_en;
            })
            ->addColumn('area_en', function ($shipping) {
                return $shipping->area_en;
            })
            ->addColumn('shipping_company', function ($shipping) {
                return $shipping->shipping_company;
            })
            ->addColumn('created_at', function ($shipping) {
                return $shipping->created_at;
            })
            ->addColumn('actions', function ($shipping) {
                return $shipping->action_buttons;
            })
            ->make(true);
    }
}
