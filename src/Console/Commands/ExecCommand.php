<?php

namespace Rahamat\SqlExec\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Rahamat\SqlExec\Console\Helper\Table;

class ExecCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sql:exec {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute .sql files';

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
        $file = $this->argument('file');
        $sqlFolder = "database/sqls";
        $filePath = base_path() . '/' . trim($sqlFolder, '/') . '/' . $file . '.sql';
        try {
            $sql = file_get_contents($filePath);
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            foreach ($statements as $statement) {
                try {
                    $this->info("Executing query: ");
                    $this->line('-----------------------------');
                    $this->comment($statement);
                    $this->line('-----------------------------');
                    $collection = DB::select($statement);
                    $this->info("Query executed successfully!");
                    $this->line('');
                    if($collection) {
                        $table = new Table($this->output);
                        $table->print($collection);
                        $this->line('');
                    }
                } catch(\Exception $e) {
                    $this->error("Error: " . $e->getMessage());
                }
            }
        } catch(\Exception $e) {
            $this->error("File {$file} not found in {$sqlFolder} folder!");
        }
    }
}