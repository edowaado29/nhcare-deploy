<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function profile(Request $request): View
    {
        $id_user = $request->session()->get('loginId');
        $usr = User::where('id_user','=',$id_user)->first();
        return view('profile.profile', compact('usr'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $id_user = $request->session()->get('loginId');
        $usr = User::findOrFail($id_user);
        
        $usr->update([
            'nomor_handphone' => $request->nomor_handphone,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir
        ]);
        
        return redirect()->route('profile')->with((['message' => 'Profile berhasil diedit']));
    }
    
    public function uploadImg(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'img_user' => 'image|mimes:jpeg,jpg,png|max:2048'
        ],
        [
            'img_user.image' => 'Format foto profil salah',
            'img_user.max' => 'Ukuran foto profil terlalu besar'
        ]);

        $id_user = $request->session()->get('loginId');
        $usr = User::findOrFail($id_user);
        
        $userImg = $request->file('img_user');
        $userImg->storeAs('public/users', $userImg->hashName());
        Storage::delete('public/users/' . $usr->img_user);
        
        $usr->update([
            'img_user' => $userImg->hashName()
        ]);

        return redirect()->route('profile')->with((['message' => 'Foto profile berhasil diedit']));
    }
    
    public function updatePassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'passwordd' => 'required|min:8|max:16'
        ],
        [
            'passwordd.required' => 'Password harus diisi!',
            'passwordd.min' => 'Password harus terdiri dari 8-16 karakter',
            'passwordd.max' => 'Password harus terdiri dari 8-16 karakter'
        ]);

        $id_user = $request->session()->get('loginId');
        $usr = User::findOrFail($id_user);

        $usr->update([
            'password' => Hash::make($request->passwordd)
        ]);

        return redirect()->route('profile')->with((['message' => 'Password berhasil diedit']));
    }
}
