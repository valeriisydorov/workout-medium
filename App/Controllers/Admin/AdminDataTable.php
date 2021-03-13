<?php


namespace App\Controllers\Admin;


class AdminDataTable
{
    protected $models = [];
    protected $functions = [];

    public function __construct($models, $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render()
    {
        $table = '<table>';
        foreach ($this->models as $row) {
            $table .= '<tr>';
            foreach ($this->functions as $column) {
                $table .= '<td>';
                $table .= $column($row);
                $table .= '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';
        return $table;
    }
}
