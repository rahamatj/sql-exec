<?php

namespace Rahamat\SqlExec\Console\Helper;

use Symfony\Component\Console\Helper\Table as SymfonyTable;

class Table {
    protected $output;

    public function __construct($output) {
        $this->output = $output;
    }

    protected function mapObjectsToArray($collection) {
        return array_map(function($object) {
            return (array) $object;
        }, $collection);
    }

    public function print($collection) {
        $collection = $this->mapObjectsToArray($collection);

        $table = new SymfonyTable($this->output);
        $table->setHeaders(array_keys($collection[0]))
                ->setRows($collection);
        $table->render();
    }
}