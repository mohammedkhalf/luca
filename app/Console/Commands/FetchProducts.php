<?php

namespace App\Console\Commands;

class FetchProducts extends AbstractFetch
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products from WP';

    protected function getTable()
    {
        return 'products';
    }

    protected function getQuery()
    {
        return "
            SELECT product_id AS id,
                   post_date AS creation_date,
                   post_date AS publishing_date,
                   post_title AS product_name,
                   sku,
                   stock_status,
                   onsale AS catalog_visibility,
                   '' AS images_gallery,
                   post_content AS description,
                   '' AS material_links,
                   '' AS category,
                   (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_regular_price' AND post_id = product_id) AS price,
                   stock_quantity AS available_qty,
                   (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_low_stock_amount' AND post_id = product_id) AS threshold,
                   0 AS recommended_price,
                   '' AS supplier,
                   0 AS supplier_code
            FROM wp_posts wp
            LEFT JOIN wp_wc_product_meta_lookup wwpml ON wp.ID = wwpml.product_id
            WHERE post_type = 'product';
        ";
    }
}
