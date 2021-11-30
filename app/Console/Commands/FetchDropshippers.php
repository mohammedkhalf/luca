<?php

namespace App\Console\Commands;

class FetchDropshippers extends AbstractFetch
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:dropshippers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch dropshippers from WP';

    protected function getTable()
    {
        return 'dropshippers';
    }

    protected function getQuery()
    {
        // meta_value AS mobile,
        return "
            SELECT
                customer_id AS id,
                wp_wc_customer_lookup.user_id,
                date_registered AS registration_date,
                CONCAT(first_name, ' ', last_name) AS name,
                email,
                username,
                (SELECT meta_value FROM wp_usermeta WHERE user_id = wp_wc_customer_lookup.user_id  AND meta_key = 'add_mobile_number' LIMIT 1) AS mobile

            FROM
                wp_wc_customer_lookup
            LEFT JOIN wp_usermeta ON wp_wc_customer_lookup.user_id = wp_usermeta.user_id AND wp_usermeta.meta_key = 'billing_phone';
        ";
    }
}
