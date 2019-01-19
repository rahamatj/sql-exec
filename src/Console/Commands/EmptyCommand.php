<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;

class EmptyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:empty {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all table rows';

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
            $this->info("Emptying {$tableName} table ...");
            DB::select("DELETE FROM {$tableName}");
            $this->info("Deleted all rows from {$tableName} table!");
            $this->line('');
        } catch(\Exception $e) {
            $this->line('');
            $this->error("Error: " . $e->getMessage());
            $this->line('');
        }
    }
}
