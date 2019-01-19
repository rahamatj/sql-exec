<?php

namespace Rahamat\SqlExec;

use Illuminate\Support\ServiceProvider;
use Rahamat\SqlExec\Console\Commands\ExecCommand;
use Rahamat\SqlExec\Console\Commands\ShowCommand;

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
        $this->commands([
            'command.exec',
            'command.show'
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.exec',
            'command.show'
        ];
    }
}
