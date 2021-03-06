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
use App\Models\OrderLine;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index(ManageOrderRequest $request)
    {
        return new ViewResponse('backend.orders.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ManageOrderRequest $request , Order $order)
    {
        $orderLines = OrderLine::where('order_id',$order->id)->get();
        $dropshipperInfo = DB::table('dropshippers')->where('id',$order->dropshipper_id)->first();
        return view('backend.orders.show',compact('order','orderLines','dropshipperInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
