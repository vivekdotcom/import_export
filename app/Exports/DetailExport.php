<?php

namespace App\Exports;

use App\Models\Detail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class DetailExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Password',
            'Created_at',
            'Updated_at' 
        ];
    } 

    public function collection()
    {
        return Detail::all();
    }
}
