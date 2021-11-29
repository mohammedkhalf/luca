<?php

namespace App\Http\Controllers\Backend\Orders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\Orders\OrderRepository;
use App\Http\Requests\Backend\Orders\ManageOrderRequest;
use App\Http\Requests\Backend\Orders\CreateOrderRequest;
use App\Http\Requests\Backend\Orders\StoreOrderRequest;
use App\Http\Requests\Backend\Orders\EditOrderRequest;
use App\Http\Requests\Backend\Orders\UpdateOrderRequest;
use App\Http\Requests\Backend\Orders\DeleteOrderRequest;
use App\Repositories\Backend\OrdersRepository;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Order\Order;

class OrdersTableController extends Controller
{
     protected $repository;
    /**
     * @param \App\Repositories\Backend\FaqsRepository $faqs
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

     public function __invoke(ManageOrderRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
                

                ->addColumn('order_id', function ($order) {
                    return $order->id;
                })
                ->addColumn('dropshipper_id', function ($order) {
                    return $order->dropshipper_id;
                })
                ->addColumn('consumer_name', function ($order) {
                    return $order->consumer_name;
                })
                ->addColumn('consumer_mobile_1', function ($order) {
                    return $order->consumer_mobile_1;
                })
                ->addColumn('region', function ($order) {
                    return $order->region;
                })
                ->addColumn('area', function ($order) {
                    return $order->area;
                })
                ->addColumn('address', function ($order) {
                    return $order->address;
                })
                ->addColumn('shipping_cost', function ($order) {
                    return $order->shipping_cost;
                })
                ->addColumn('order_total_net', function ($order) {
                    return $order->order_total_net;
                })
                // ->addColumn('status', function ($order) {
                //     return $order->status;
                // })
                ->addColumn('creation_date', function ($order) {
                    return $order->creation_date;
                })
            
                ->addColumn('actions', function ($order) {

                    $btn =
                        '<a href="#" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.show').'" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>';
                    return $btn;
                })

                ->addColumn('selected', function ($order) {
                    $btn = '<input type="checkbox" name="orders[]" value="'.$order->id.'"/>';
                    return $btn;
                })
                ->rawColumns(['actions','selected'])
                ->make(true);
    }


}
