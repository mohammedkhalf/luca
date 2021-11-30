<?php

namespace App\Console\Commands;

use App\Console\Commands\Concern\ParsesRecords;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

abstract class AbstractFetch extends Command
{
    use ParsesRecords;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Truncate current table
        DB::connection('operation')->statement('TRUNCATE ' . $this->getTable());

        // Get all records
        $records = $this->parseRecords(DB::connection('wp')->select($this->getQuery()));

        // Save them to the operation database
        $this->insertRecords($records);
    }

    protected function insertRecords($records)
    {
        DB::connection('operation')->table($this->getTable())->insert($records);
    }

    abstract protected function getTable();

    abstract protected function getQuery();
}
