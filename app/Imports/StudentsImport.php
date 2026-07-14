<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pastikan baris memiliki NIS dan Nama (kolom wajib)
        if (!isset($row['nis']) || !isset($row['nama'])) {
            return null;
        }

        // Cek apakah NIS sudah ada, jika ada skip atau update
        $student = Student::where('nis', $row['nis'])->first();
        if ($student) {
            return null; // Skip if exists
        }

        $tanggal_lahir = null;
        if (isset($row['tanggal_lahir'])) {
            try {
                $tanggal_lahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d');
            } catch (\Exception $e) {
                // If it's already a string like '2000-01-01', fallback to it
                $tanggal_lahir = date('Y-m-d', strtotime($row['tanggal_lahir']));
            }
        }

        return new Student([
            'nis'           => $row['nis'],
            'nama'          => $row['nama'],
            'tempat_lahir'  => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $tanggal_lahir,
            'alamat'        => $row['alamat'] ?? null,
            'no_telp'       => $row['no_telp'] ?? null,
        ]);
    }
}
