<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validasi input termasuk memastikan name unik di tabel users
    $request->validate([
        'username' => 'required|string|max:255|unique:users', 
        'fullname' => 'required|string|max:255|unique:users', 
        'address' => 'required|string|max:255|unique:users', 
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'username.unique' => 'This username is already taken. Please choose another one.',
        'email.unique' => 'This email is already taken. Please choose another one.',
    ]);

    // Membuat user baru jika validasi berhasil
    $user = new User();
    $user->username = $request->username;
    $user->fullname = $request->fullname;
    $user->address = $request->address;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    // Redirect to the login page with a success message
    return redirect()->route('login')->with('success', 'Registration successful! Please login.');
}

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Attempt login
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->route('home');
    }

    // Custom error messages for both email and password
    return redirect()->back()->withErrors([
        'email' => 'The provided email is incorrect.',  // Custom error message for email
        'password' => 'The password you entered is incorrect.',  // Custom error message for password
    ])->withInput();  // Keep the input except for password
}


    public function logout(Request $request)
    {
        Auth::logout();  // Mengeluarkan pengguna
        $request->session()->invalidate();  // Menghapus semua data sesi
        $request->session()->regenerateToken();  // Membuat ulang token untuk keamanan

        return redirect('/login');  // Arahkan ke halaman login
    }

    public function destroySession(Request $request)
    {
        $request->session()->flush();  // Hapus semua data sesi

        return redirect('/home');  // Arahkan kembali ke halaman yang diinginkan
    }

    // Show form to request reset link
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Handle sending of reset password email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    // Show form to reset password
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Handle password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    // Tampilkan row user maksimal 10 per page di admin
    

}
