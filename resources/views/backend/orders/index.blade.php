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
                    <form name="frm-example" id="frm-example"> 

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
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>

                            <p><b>Form data:</b></p>
                            <div id="example-console-form"></div>

                            <p><b>Count Selected : </b></p>
                            <div id="count-selected"></div>


                    </form>

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

                //display Checkbox in column
                $('body').on('change', '#mass_select_all', function() {
                    var rows, checked;
                    rows = $('#orders-table').find('tbody tr');
                    checked = $(this).prop('checked');
                    $.each(rows, function() {
                        var checkbox = $($(this).find('td').eq(0)).find('input').prop('checked', checked);
                    });
                });

            //POST Request Orders ID 
            var table = $('#orders-table').dataTable();
            // Handle form submission event 
            $('#frm-example').on('submit', function(e){
                // Prevent actual form submission
                e.preventDefault();
                // Serialize form data
                var data = table.$('input[type="checkbox"]').serialize(); 

                console.log(data);

                // Submit form data via Ajax
                $.ajax({
                    url: '/echo/jsonp/',
                    data: data,
                    success: function(data){
                        console.log('Server response', data);
                    }
                });
                // FOR DEMONSTRATION ONLY
                // The code below is not needed in production
                
                // Output form data to a console     
                $('#example-console-form').text(data);
                // Output form data to a console     
                $('#count-selected').text($('input:checkbox:checked').length);
            });
        });
</script>

@stop