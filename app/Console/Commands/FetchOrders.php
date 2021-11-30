<?php

namespace App\Console\Commands;

use App\Console\Commands\Concern\ParsesRecords;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Shipping;

class FetchOrders extends Command
{
    use ParsesRecords;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch orders from WP';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::transaction(function () {
            $fetchedOrderIds = $this->fetchNewOrders();

            if (count($fetchedOrderIds)) {
                $this->fetchNewOrderLines($fetchedOrderIds);
                $this->fetchNewOrderStatuses($fetchedOrderIds);
            }
        });
    }

    protected function fetchNewOrders()
    {
        $lastFetchedOrder = DB::connection('operation')->table('orders')->orderBy('id', 'DESC')->first();
        $lastFetchedOrderId = $lastFetchedOrder ? $lastFetchedOrder->id : 0;
        $query = "
            SELECT wos.order_id AS id,
                   date_created AS creation_date,
                   customer_id AS dropshipper_id,
                   CONCAT(
                       (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_shipping_first_name' LIMIT 1),
                       ' ',
                       (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_shipping_last_name' LIMIT 1)
                   ) AS consumer_name,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_billing_phone' LIMIT 1) AS consumer_mobile_1,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_billing_mobile' LIMIT 1) AS consumer_mobile_2,
                   region,
                   area,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_shipping_address_1' LIMIT 1) AS address,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_billing_company' LIMIT 1) AS store_name,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = '_shipping_city' LIMIT 1) AS area,
                   (SELECT meta_value FROM wp_postmeta WHERE post_id = wos.order_id AND meta_key = 'shipping_company' LIMIT 1) AS shipping_company,
                   shipping_total AS shipping_cost,
                   total_sales AS order_total_sales,
                   net_total AS order_total_net
            FROM wp_wc_order_stats wos
            LEFT JOIN wp_order_listing wol ON wos.order_id = wol.order_id
            WHERE wos.order_id > {$lastFetchedOrderId};
        ";
        // ORDER BY wos.order_id DESC
        $orders = DB::connection('wp')->select($query);

        $orders = $this->getShippingCompany($orders);
        
        // dd($orders);
        $fetchedOrderIds = [];

        foreach ($orders as $order) {
            $fetchedOrderIds[] = $order->id;
        }

        foreach (array_chunk($orders, 500) as $chunk) {
            DB::connection('operation')->table('orders')->insert(
                $this->parseRecords($chunk)
            );
        }

        return $fetchedOrderIds;
    }

    protected function fetchNewOrderLines($fetchedOrderIds)
    {
        $fetchedOrderIds = implode(',', $fetchedOrderIds);

        $query = "
            SELECT wwopl.order_id,
                   product_id,
                   wwopl.order_item_id AS line_id,
                   variation_id AS variation,
                   product_gross_revenue AS selling_price_gross,
                   (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_regular_price' AND post_id = product_id) AS regular_price,
                   order_item_type,
                   date_created AS creation_date,
                   product_qty AS qty,
                   customer_id
            FROM wp_wc_order_product_lookup wwopl
            LEFT JOIN wp_woocommerce_order_items wwoi ON wwopl.order_item_id = wwoi.order_item_id
            WHERE wwopl.order_id IN ({$fetchedOrderIds});
        ";

        $lines = DB::connection('wp')->select($query);

        foreach (array_chunk($lines, 500) as $chunk) {
            DB::connection('operation')->table('order_lines')->insert(
                $this->parseRecords($chunk)
            );
        }
    }

    protected function fetchNewOrderStatuses($fetchedOrderIds)
    {
        $fetchedOrderIds = implode(',', $fetchedOrderIds);

        $query = "
            SELECT id AS order_id, post_status AS status, NOW() AS creation_date 
            FROM wp_posts 
            WHERE post_type = 'shop_order' AND id IN ({$fetchedOrderIds});
        ";

        $statuses = DB::connection('wp')->select($query);

        DB::connection('operation')->table('order_statuses')->insert(
            $this->parseRecords($statuses)
        );
    }

    //update shipping Company
    protected function getShippingCompany($orders)
    {
        foreach($orders as $order){
            if(!empty($order->shipping_company)){
                continue;
            }else{
                $shippingCompany = Shipping::where('area',$order->area)->value('shipping_company');
                $order->shipping_company = $shippingCompany;
            }
        }
        return $orders;
    }

}
