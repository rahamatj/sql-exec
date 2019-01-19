<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;

class DropCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:drop {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop table from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tableName = $this->argument('table_name');

        try {
            $this->line('');
            $this->info("Dropping {$tableName} table ...");
            DB::select("DROP TABLE {$tableName}");
            $this->info("{$tableName} table dropped!");
            $this->line('');
        } catch (\Exception $e) {
            $this->line('');
            $this->error("Error: " . $e->getMessage());
            $this->line('');
        }
    }
}
