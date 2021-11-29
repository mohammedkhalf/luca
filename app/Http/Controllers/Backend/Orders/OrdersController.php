<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Orders\CreateOrdersRequest;
use App\Http\Requests\Backend\Orders\DeleteOrdersRequest;
use App\Http\Requests\Backend\Orders\EditOrdersRequest;
use App\Http\Requests\Backend\Orders\StoreOrdersRequest;
use App\Http\Requests\Backend\Orders\UpdateOrdersRequest;
use App\Http\Requests\Backend\Orders\ManageOrderRequest;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\OrdersRepository;
use App\Models\Order;
use App\Http\Responses\RedirectResponse;

class OrdersController extends Controller
{
     /**
     * variable to store the repository object
     * @var OrdersRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param OrderRepository $repository;
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  App\Http\Requests\Backend\Order\ManageOrderRequest  $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageOrderRequest $request)
    {
        return new ViewResponse('backend.orders.index');
    }
}
