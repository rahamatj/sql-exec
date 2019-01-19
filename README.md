# Laravel MySQL Management Tool
SQL Exec is an artisan plugin that I wrote in order to run .sql files and play with raw SQLs.

## Features
- Execute .sql files
- List MySQL tables
- Show table structure
- List table rows

## Installation
- `composer require rahamatjahan/sql-exec`
- Next, add the Service Provider in your `config/app.php` inside of the `providers[]` array:

```
'providers' => [

    /*
    * Package Service Providers...
    */

    RahamatJahan\SqlExec\SqlExecServiceProvider::class,

],
```


## Commands
The plugin adds the following commands to artisan, all prefixed by `php artisan`.

Command | Description | Example
--------|-------------|--------
sql:exec {file_name} | Execute a .sql file kept in the `database/sqls` folder. Filename in the command doesn't need the .sql extension. | `php artisan sql:exec create_employees_table`
sql:describe {table_name} | Show table structure. | `php artisan sql:describe employees`
sql:show {table_name} | Show table rows. | `php artisan sql:show employees`
sql:empty {table_name} | Delete all table rows. | `php artisan sql:empty employees`
sql:drop {table_name} | Drop table from database. | `php artisan sql:drop employees`
sql:tables | List all tables in the database. | `php artisan sql:tables`
sql:tables --empty | Empty all tables. | `php artisan sql:tables --empty`
sql:tables --drop | Drop all tables from database. | `php artisan sql:tables --drop`
