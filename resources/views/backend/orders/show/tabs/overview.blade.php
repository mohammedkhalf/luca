<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.order_id') }}</th>
                    <td> {{ $order->id }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.creation_date') }}</th>
                    <td> {{ $order->creation_date }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.dropshipper_id') }}</th>
                    <td> {{ $order->dropshipper_id }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.user_id') }}</th>
                    <td> {{ $dropshipperInfo->user_id }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.dropshipper_name') }}</th>
                    <td> {{ $dropshipperInfo->NAME }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.dropshipper_email') }}</th>
                    <td> {{ $dropshipperInfo->email }} </td>
                </tr>
                
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.dropshipper_mobile') }}</th>
                    <td> {{ $dropshipperInfo->mobile }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.consumer_name') }}</th>
                    <td> {{ $order->consumer_name }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.consumer_mobile_1') }}</th>
                    <td> {{ $order->consumer_mobile_1 }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.consumer_mobile_2') }}</th>
                    <td> {{ $order->consumer_mobile_2 }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.region') }}</th>
                    <td> {{ $order->region }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.area') }}</th>
                    <td> {{ $order->area }} </td>
                </tr>
                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.address') }}</th>
                    <td> {{ $order->address }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.store_name') }}</th>
                    <td> {{ $order->store_name }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.shipping_company') }}</th>
                    <td> {{ $order->shipping_company }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.shipping_cost') }}</th>
                    <td> {{ $order->shipping_cost }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.order_total_net') }}</th>
                    <td> {{ $order->order_total_net }} </td>
                </tr>

                <tr>
                    <th>{{ trans('labels.backend.access.orders.table.status') }}</th>
                    <td> {{ DB::table('order_statuses')->where('order_id',$order->id)->value('status') }} </td>
                </tr>

                @foreach($orderLines as $orderLine)
                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.product_id') }}</th>
                        <td> {{ $orderLine->product_id }} </td>
                    </tr>
                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.product_name') }}</th>
                        <td> {{ DB::table('products')->where('id',$orderLine->product_id)->value('product_name') }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.qty') }}</th>
                        <td> {{ $orderLine->qty }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.sku') }}</th>
                        <td> {{ DB::table('products')->where('id',$orderLine->product_id)->value('sku') }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.line_id') }}</th>
                        <td> {{ $orderLine->line_id }} </td>
                    </tr>
                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.variation') }}</th>
                        <td> {{ $orderLine->variation }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.selling_price_gross') }}</th>
                        <td> {{ $orderLine->selling_price_gross }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.regular_price') }}</th>
                        <td> {{ $orderLine->regular_price }} </td>
                    </tr>

                    <tr>
                        <th>{{ trans('labels.backend.access.orders.table.order_item_type') }}</th>
                        <td> {{ $orderLine->order_item_type }} </td>
                    </tr>
                @endforeach

          
        </table>
    </div>
</div><!--table-responsive-->
