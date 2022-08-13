<?php


namespace laililmahfud\starterkit\helpers\excel;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToModel, WithHeadingRow
{
    private $collection;

    public function model(array $row)
    {
        $this->collection[] = $row;
    }

    public function getCollection(){
        return $this->collection;
    }
}
