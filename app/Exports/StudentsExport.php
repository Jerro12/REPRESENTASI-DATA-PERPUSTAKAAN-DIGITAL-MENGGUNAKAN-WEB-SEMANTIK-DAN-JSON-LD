<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromArray, WithHeadings
{
    /**
    * @return array
    */
    public function array(): array
    {
        // Return dummy data / template data
        return [
            [
                '1234567890', 
                'Nama Siswa Contoh', 
                'Jakarta', 
                '2005-08-17', 
                'Jl. Contoh No. 123', 
                '081234567890'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'nis',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'no_telp',
        ];
    }
}
