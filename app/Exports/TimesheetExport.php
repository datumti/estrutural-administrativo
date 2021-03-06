<?php

namespace App\Exports;

use App\Models\Timesheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Construction;

class TimesheetExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $filter;
    protected $construction;

    public function __construct($filter, Construction $construction)
    {
        $this->filter = $filter;
        $this->construction = $construction;
    }

    public function collection()
    {



        return $this->timesheets;
    }

    public function headings(): array
    {
        return [
           ['EFETIVO DIÁRIO DE OBRA'],
           ['Second row', 'Second row'],
        ];
    }

}
