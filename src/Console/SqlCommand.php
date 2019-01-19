<?php

namespace RahamatJahan\SqlExec\Console;

use DB;
use PDOException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use RahamatJahan\SqlExec\Console\Helper\Collection;
use RahamatJahan\SqlExec\Exceptions\SqlExecException;


class SqlCommand extends Command {
    public function describe($tableName) {
        try {
            $contents = Collection::mapObjectsToArrays(
                DB::select("DESCRIBE ${tableName}")
            );

            $table = new Table($this->output);
            $table->setHeaders([
                        'Field',
                        'Type',
                        'Null',
                        'Key',
                        'Default',
                        'Extra'
                    ])
                    ->setRows($contents);
            $this->line('');
            $table->render();
            $this->line('');
        } catch(PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function drop($tableName) {
        try {
            $this->line('');
            $this->info("Dropping {$tableName} table ...");
            DB::select("DROP TABLE {$tableName}");
            $this->info("{$tableName} table dropped!");
            $this->line('');
        } catch (PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function empty($tableName) {
        try {
            $this->line('');
            $this->info("Emptying {$tableName} table ...");
            DB::select("DELETE FROM {$tableName}");
            $this->info("Deleted all rows from {$tableName} table!");
            $this->line('');
        } catch(PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function exec($filePath) {
        try {
            $sql = file_get_contents($filePath);
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            foreach ($statements as $statement) {
                try {
                    $this->line('');
                    $this->info("Executing query ... ");
                    $this->line('-----------------------------');
                    $this->comment($statement);
                    $this->line('-----------------------------');
                    $collection = Collection::mapObjectsToArrays(
                        DB::select($statement)
                    );
                    $this->info("Query executed successfully!");
                    $this->line('');
                    if($collection) {
                        $table = new Table($this->output);
                        $table->setHeaders(
                                    array_keys($collection[0])
                                )
                                ->setRows($collection);
                        $table->render();
                        $this->line('');
                    }
                } catch(PDOException $e) {
                    throw new SqlExecException($e->getMessage());
                }
            }
        } catch(PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function show($tableName) {
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
        } catch(PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function tables() {
        $databaseName = config('database.connections.mysql.database');
        try {
            $tables = Collection::mapObjectsToArrays(
                DB::select("SHOW TABLES")
            );
            $table = new Table($this->output);
            $table->setHeaders([
                        "Tables in {$databaseName}"
                    ])
                    ->setRows($tables);
            $this->line('');
            $table->render();
            $this->line('');
        } catch(PDOException $e) {
            throw new SqlExecException($e->getMessage());
        }
    }

    public function showErrorMessage($error) {
        $this->line('');
        $this->error("Error: " . $error->getMessage());
        $this->line('');
    }
}