<?php

namespace Rahamat\SqlExec;

use Illuminate\Support\ServiceProvider;
use Rahamat\SqlExec\Console\Commands\ExecCommand;

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
        $this->commands(['command.exec']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.exec'];
    }
}
