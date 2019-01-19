<?php

namespace RahamatJahan\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use RahamatJahan\SqlExec\Console\Helper\Table;

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
            $collection = DB::select("SELECT * FROM {$tableName}");

            $table = new Table($this->output);
            $this->line('');
            $table->print($collection);
            $this->line('');
        } catch(\Exception $e) {
            $this->line('');
            $this->error("Error: " . $e->getMessage());
            $this->line('');
        }
    }
}
