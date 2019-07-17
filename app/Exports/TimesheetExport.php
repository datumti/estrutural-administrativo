<?php

namespace App\Exports;

use App\Timesheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TimesheetExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Timesheet::all();
    }

    public function headings(): array
    {
        return [
           ['First row', 'First row'],
           ['Second row', 'Second row'],
        ];
    }

}
