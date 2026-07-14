<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;

class CheckNisController extends Controller
{
    public function __invoke(Request $request)
    {
        $nis = $request->query('nis');

        if (!$nis) {
            return response()->json(['status' => 'error', 'message' => 'NIS tidak boleh kosong.']);
        }

        // Cek apakah NIS ada di master data siswa
        $student = Student::where('nis', $nis)->first();

        if (!$student) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIS tidak terdaftar di sistem sekolah.'
            ]);
        }

        // Cek apakah NIS sudah digunakan di akun User
        $userExists = User::where('nis', $nis)->exists();
        if ($userExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIS ini sudah memiliki akun, silakan login.'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'data' => $student
        ]);
    }
}
