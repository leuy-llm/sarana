<?php

namespace App\Exports;

use App\Models\Guest;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class GuestExport implements FromView //FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //

    //     return Guest::select('name','phone','email','address','date');

    // }

    // public function headings(): array
    // {
    //     return [
    //         'Name',
    //         'Phone',
    //         'Email',
    //         'Address',
    //         'date',
    //     ];
    // }
    public function view(): View
    {
        return view('back_end.guest.export', [
            'guests' => Guest::all()
        ]);
    }

    
}
