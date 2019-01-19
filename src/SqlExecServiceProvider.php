<?php

namespace RahamatJahan\SqlExec;

use Illuminate\Support\ServiceProvider;
use RahamatJahan\SqlExec\Console\Commands\ExecCommand;
use RahamatJahan\SqlExec\Console\Commands\ShowCommand;
use RahamatJahan\SqlExec\Console\Commands\DropCommand;
use RahamatJahan\SqlExec\Console\Commands\EmptyCommand;
use RahamatJahan\SqlExec\Console\Commands\TablesCommand;
use RahamatJahan\SqlExec\Console\Commands\DescribeCommand;

class SqlExecServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.exec', function () {
            return new ExecCommand;
        });

        $this->app->singleton('command.show', function () {
            return new ShowCommand;
        });

        $this->app->singleton('command.tables', function () {
            return new TablesCommand;
        });

        $this->app->singleton('command.describe', function () {
            return new DescribeCommand;
        });

        $this->app->singleton('command.drop', function () {
            return new DropCommand;
        });

        $this->app->singleton('command.empty', function () {
            return new EmptyCommand;
        });

        $this->commands([
            'command.exec',
            'command.show',
            'command.tables',
            'command.describe',
            'command.drop',
            'command.empty'
        ]);
    }
}
