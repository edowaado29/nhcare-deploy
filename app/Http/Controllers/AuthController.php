<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('auth.login');
    }

    public function index(){
        return redirect('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([            
            'email'=>'required|email:users',
            'passwordd'=>'required'
        ],
        [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'passwordd.required' => 'Password harus diisi!'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->passwordd, $user->password)){
                $request->session()->put('loginId', $user->id_user);
                $request->session()->put('loginSuccess', 'Login Berhasil!');

                if ($request->has('remember_me')) {
                    Cookie::queue('email', $request->email, 43200);
                    Cookie::queue('password', $request->passwordd, 43200);
                } else {
                    Cookie::queue(Cookie::forget('email'));
                    Cookie::queue(Cookie::forget('password'));
                }
                
                return redirect('dashboard');
            } else {
                return back()->with('fail','Email atau password salah!');
            }
        } else {
            return back()->with('fail','Email belum terdaftar.');
        }        
    }

    public function forgot_password(){
        return view('auth.lupa_password');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = \Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot_password')->with('success', 'Permintaan berhasil dikirim ke email Anda');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        return view('auth.validasi-token', compact('token'));
    }

    public function validasi_forgot_password_act(Request $request)
    {
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus terdiri dari 8-16 karakter',
            'password.max' => 'Password harus terdiri dari 8-16 karakter',
        ];

        $request->validate([
            'password' => 'required|min:8|max:16'
        ], $customMessage);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();

        Session::put('ResetPasswordSuccess', 'Reset Password Berhasil!');
        return redirect()->route('login')->with('success', 'Password berhasil direset');
    }

    public function logout()
    {
        $data = array();
        if(Session::has('loginId')){
            Session::pull('loginId');
            Session::put('logoutSuccess', 'Logout Berhasil!');
            return redirect('login');
        }
    }
}