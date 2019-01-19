<?php

namespace Rahamat\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Rahamat\SqlExec\Console\Helper\Table;

class DescribeCommand extends Command
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
    protected $description = 'Describe table structure';

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
            $contents = DB::select("DESCRIBE ${tableName}");

            $table = new Table($this->output);
            $table->print($contents);
            $this->line('');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
