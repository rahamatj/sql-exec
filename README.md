# Laravel MySQL Management Tool
SQL Exec is an artisan plugin that I wrote in order to run .sql files and play around with raw SQL Queries.

## Features
- Execute .sql files
- List MySQL tables
- Show table structure
- List table rows
- Delete all rows from table
- Drop table
- Empty all tables from database
- Delete all tables from database

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
sql:drop --force {table_name} | Add `--force` option (`-f` for short) with `drop` to forcefully drop table from database without foreign key checks. | `php artisan sql:drop --force employees`
sql:tables | List all tables in the database. | `php artisan sql:tables`
sql:tables --empty | Add `--empty` option (`-e` for short) with `tables` to empty all tables. | `php artisan sql:tables --empty`
sql:tables --drop | Add `--drop` option (`-d` for short) with `tables` to drop all tables from database. | `php artisan sql:tables --drop`
sql:tables --drop --force | Add `--drop --force` options (`-d -f` for short) with `tables` to forcefully drop all tables from database without foreign key checks. | `php artisan sql:tables --drop --force`

