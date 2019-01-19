<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use RahamatJahan\SqlExec\Console\SqlCommand;
use RahamatJahan\SqlExec\Console\Helper\Collection;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;

class TablesCommand extends SqlCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:tables {--drop} {--empty}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all tables in the database';

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
        $databaseName = config('database.connections.mysql.database');
        try {
            $tableNames = Collection::mapObjectsToPropertyValues(
                DB::select("SHOW TABLES"),
                "Tables_in_" . $databaseName
            );

            if($this->option('drop')) {
                foreach($tableNames as $tableName) {
                    try {
                        $this->drop($tableName);
                    } catch (SqlExecException $e) {
                        $this->showErrorMessage($e);
                    }
                }
            } else if($this->option('empty')) {
                foreach($tableNames as $tableName) {
                    try {
                        $this->empty($tableName);
                    } catch(SqlExecException $e) {
                        $this->showErrorMessage($e);
                    }
                }
            } else {
                try {
                    $this->tables();
                } catch(SqlExecException $e) {
                    $this->showErrorMessage($e);
                }
            }
        } catch(SqlExecException $e) {
            $this->showErrorMessage($e);
        }
    }
}
