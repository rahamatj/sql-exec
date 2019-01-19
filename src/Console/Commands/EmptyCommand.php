<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use RahamatJahan\SqlExec\Console\SqlCommand;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;

class EmptyCommand extends SqlCommand
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
            $this->empty($tableName);
            $this->show($tableName);
        } catch(SqlExecException $e) {
            $this->showErrorMessage($e);
        }
    }
}
