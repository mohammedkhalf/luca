@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.shippings.management'))

@section('breadcrumb-links')
@include('backend.shippings.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.shippings.management') }} <small class="text-muted">{{ __('labels.backend.access.shippings.active') }}</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                        <table id="shippings-table" class="table" data-ajax_url="{{ route("admin.shippings.get") }}">
                            <thead>
                                <tr>
                                    <th>{{ trans('labels.backend.access.shippings.table.id') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.region') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.area') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.region_en') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.area_en') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.shipping_company') }}</th>
                                    <th>{{ trans('labels.backend.access.shippings.table.createdat') }}</th>
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
            $('#shippings-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: $('#shippings-table').data('ajax_url'),
                        type: 'post',
                    },
                    columns: [
                        {data: 'id', name: 'shippings.id'},
                        {data: 'region', name: 'shippings.region'},
                        {data: 'area', name: 'shippings.area'},
                        {data: 'region_en', name: 'shippings.region_en'},
                        {data: 'area_en', name: 'shippings.area_en'},
                        {data: 'shipping_company', name: 'shippings.shipping_company'},
                        {data: 'created_at', name: 'shippings.created_at'},
                        {data: 'actions', name: 'actions', searchable: false, sortable: false}
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