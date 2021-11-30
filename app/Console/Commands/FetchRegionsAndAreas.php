<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Shipping;

class FetchRegionsAndAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:regions-and-areas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch regions and areas from WP';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $regionQuery = "SELECT option_id , option_name, option_value  FROM wp_options WHERE option_name LIKE 'options_add_region_main_%_add_region' ";
        $areaQuery = "SELECT option_name, option_value  FROM wp_options WHERE option_name LIKE 'options_add_region_main_%_add_cities_%_add_city'";
        $regions = DB::connection('wp')->select($regionQuery);
        $areas = DB::connection('wp')->select($areaQuery);
        
        $parsed = [];
        foreach ($regions as $region) {
            $parsed[$this->getRegionIndex($region)] = [
                'region_id' => $region->option_id,
                'name' => $region->option_value,
                'areas' => []
            ];
        }

        foreach ($areas as $area) {
            $regionIndex = $this->getRegionIndex($area);
            $parsed[$regionIndex]['areas'][] = $area->option_value;
        }

        //Insert into the database
        foreach($parsed as $key=>$value){
            for($i=0;$i<count($value['areas']);$i++){
                Shipping::create([
                    'region_id'=>$value['region_id'],
                    'region'=>$value['name'],
                    'area'=>$value['areas'][$i],

                ]);
            }
        }
    }

    protected function getRegionIndex($region)
    {
        $prefix = 'options_add_region_main_';
        $withoutPrefix = str_replace($prefix, '', $region->option_name);

        return intval(
            substr($withoutPrefix, 0, strpos($withoutPrefix, '_'))
        );
    }
}
