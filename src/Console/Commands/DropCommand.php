<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use RahamatJahan\SqlExec\Console\SqlCommand;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;

class DropCommand extends SqlCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:drop {table_name}
                            {--f|force : Disable foreign key checks while dropping tables}';

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
        $force = $this->option('force');
        try {
            if($force)
                DB::select("SET FOREIGN_KEY_CHECKS = 0");
            $this->drop($tableName);
            if($force)
                DB::select("SET FOREIGN_KEY_CHECKS = 1");
            $this->tables();
        } catch (SqlExecException $e) {
            $this->showErrorMessage($e);
        }
    }
}
