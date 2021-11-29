@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.orders.management'))

@section('breadcrumb-links')
@include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.orders.management') }} <small class="text-muted">{{ __('labels.backend.access.orders.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="orders-table" class="table" data-ajax_url="{{ route("admin.orders.get") }}">
                        <thead>
                            <tr>
                                <th>  <input type="checkbox" id="mass_select_all" data-to-table="tasks"> </th>
                                <th>{{ trans('labels.backend.access.orders.table.order_id') }}</th>
                                <th>{{ trans('labels.backend.access.orders.table.dropshipper_id') }}</th>
                                <th>{{ trans('labels.backend.access.orders.table.consumer_name') }}</th>
                                <th>{{ trans('labels.backend.access.orders.table.consumer_mobile_1') }}</th>
                                <th>{{ trans('labels.backend.access.orders.table.address') }}</th>
                                <!-- <th>{{ trans('labels.backend.access.orders.table.status') }}</th> -->
                                <th>{{ trans('labels.backend.access.orders.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')
<script>
       FTX.Utils.documentReady(function() {
         $('#orders-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: $('#orders-table').data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                    {data: 'selected', name: 'selected', searchable: false, orderable: false},
                    {data: 'id', name: '{{config('module.orders.table')}}.id'},
                    {data: 'dropshipper_id', name: '{{config('module.orders.table')}}.dropshipper_id'},
                    {data: 'consumer_name', name: '{{config('module.orders.table')}}.consumer_name'},
                    {data: 'consumer_mobile_1', name: '{{config('module.orders.table')}}.consumer_mobile_1'},
                    {data: 'address', name: '{{config('module.orders.table')}}.address'},
                    // {data: 'status', name: '{{config('module.orders.table')}}.status'},
                    {data: 'creation_date', name: '{{config('module.orders.table')}}.creation_date'},
                    { data: 'actions', name: 'actions', searchable: false, sortable: false }
                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
    });
</script>

@stop