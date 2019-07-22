<?php

namespace App\Exports;

use App\Models\Construction;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TimesheetViewExport implements FromView, ShouldAutoSize
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

    public function view(): View
    {

        return view('exports.timesheet', ['construction' => $this->construction, 'filter' => $this->filter]);

    }

    public function headings(): array
    {
        return [
           ['EFETIVO DIÁRIO DE OBRA'],
           ['Second row', 'Second row'],
        ];
    }

}
