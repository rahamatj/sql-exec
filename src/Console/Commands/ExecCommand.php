<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use RahamatJahan\SqlExec\Console\SqlCommand;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;

class ExecCommand extends SqlCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:exec {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute a .sql file';

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
        $file = $this->argument('file_name');
        $sqlFolder = "database/sqls";
        $filePath = base_path() . '/' . trim($sqlFolder, '/') . '/' . $file . '.sql';
        
        try {
            $this->exec($filePath);
        } catch(SqlExecException $e) {
            $this->showErrorMessage($e);
        }
    }
}
