<?php

namespace App\Console\Commands\Concern;

trait ParsesRecords
{
    protected function parseRecords($records)
    {
        return array_map(function ($record) {
            return (array)$record;
        }, $records);
    }
}
