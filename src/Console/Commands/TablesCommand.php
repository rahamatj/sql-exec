<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use RahamatJahan\SqlExec\Console\Helper\Collection;

class TablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:tables';

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
        try {
            $tables = Collection::mapObjectsToArrays(
                        DB::select("SHOW TABLES")
                    );
            $databaseName = config('database.connections.mysql.database');
            
            $table = new Table($this->output);
            $table->setHeaders([
                        "Tables in {$databaseName}"
                    ])
                    ->setRows($tables);
            $this->line('');
            $table->render();
            $this->line('');
        } catch(\Exception $e) {
            $this->line('');
            $this->error("Error: " . $e->getMessage());
            $this->line('');
        }
    }
}
