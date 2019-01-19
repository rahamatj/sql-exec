<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use RahamatJahan\SqlExec\Console\SqlCommand;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;

class DescribeCommand extends SqlCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:describe {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show table structure';

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
           $this->describe($tableName);
        } catch(SqlExecException $e) {
            $this->showErrorMessage($e);
        }
    }
}
