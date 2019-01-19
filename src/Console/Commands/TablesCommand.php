<?php

namespace Rahamat\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Rahamat\SqlExec\Console\Helper\Table;

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
    protected $description = 'Show all tables in the database';

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
            $tables = DB::select("SHOW TABLES");

            $table = new Table($this->output);
            $this->line('');
            $table->print($tables);
            $this->line('');
        } catch(\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
