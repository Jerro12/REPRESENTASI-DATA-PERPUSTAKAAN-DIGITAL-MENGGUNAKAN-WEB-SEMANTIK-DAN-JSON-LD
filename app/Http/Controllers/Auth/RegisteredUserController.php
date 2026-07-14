<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Pastikan NIS ada di master data siswa
        $student = \App\Models\Student::where('nis', $request->nis)->first();
        if (!$student) {
            return back()->withInput()->withErrors(['nis' => 'NIS tidak terdaftar sebagai siswa sekolah.']);
        }

        $user = User::create([
            'nis' => $student->nis,
            'name' => $student->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tempat_lahir' => $student->tempat_lahir,
            'tanggal_lahir' => $student->tanggal_lahir,
            'alamat' => $student->alamat,
            'no_telp' => $student->no_telp,
        ]);

        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
