<?php

namespace App\Http\Controllers\Backend\Shippings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\ShippingsRepository;
use App\Http\Requests\Backend\Shipping\ManageShippingRequest;
use App\Http\Requests\Backend\Shipping\CreateShippingRequest;
use App\Http\Requests\Backend\Shipping\StoreShippingRequest;
use App\Http\Requests\Backend\Shipping\EditShippingRequest;
use App\Http\Requests\Backend\Shipping\UpdateShippingRequest;
use App\Http\Requests\Backend\Shipping\DeleteShippingRequest;

class ShippingsController extends Controller
{
     /**
     * variable to store the repository object
     * @var ShippingRepository
     */
     protected $repository;

    /**
     * contructor to initialize repository object
     * @param ShippingRepository $repository;
     */
    public function __construct(ShippingsRepository $repository)
    {
        $this->repository = $repository;
    }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageShippingRequest $request)
    {
        return new ViewResponse('backend.shippings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateShippingRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingRequest  $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping, EditShippingRequest $request)
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
    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping, DeleteShippingRequest $request)
    {
        //
    }
}
