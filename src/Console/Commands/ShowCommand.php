<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use RahamatJahan\SqlExec\Console\Helper\Collection;

class ShowCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:show {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show table rows';

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
            $collection = Collection::mapObjectsToArrays(
                                DB::select("SELECT * FROM {$tableName}")
                            );
            $columns = Collection::mapObjectsToPropertyValues(
                                DB::select("SHOW COLUMNS FROM {$tableName}"),
                                'Field'
                            );
            
            $table = new Table($this->output);
            $table->setHeaders($columns)
                    ->setRows($collection);
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
