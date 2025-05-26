<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Kedonaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class KedonaturanController extends Controller
{
    public function kedonaturan(): View
    {
        $donatur = Kedonaturan::all();
        return view('kedonaturan.kedonaturan', compact('donatur'));
    }

    public function detail_donatur(string $id): view
    {
        $donatur = Kedonaturan::findOrFail($id);

        return view('kedonaturan.detail_kedonaturan', compact('donatur'));
    }

    public function tambah_donatur(): View
    {
        return view('kedonaturan.tambah_kedonaturan');
    }

    public function tambahDon(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_donatur' => 'required',
            'email' => 'required|email',
            'passwordd' => 'required|min:8|max:16',
            'foto_donatur' => 'image|mimes:jpeg,jpg,png|max:2048',
        ],
        [
            'nama_donatur.required' => 'Nama donatur harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'passwordd.required' => 'Password harus diisi!',
            'passwordd.min' => 'Password harus terdiri dari 8-16 karakter',
            'passwordd.max' => 'Password harus terdiri dari 8-16 karakter',
            'foto_donatur.image' => 'Format foto salah!',
            'foto_donatur.max' => 'Ukuran foto terlalu besar'
        ]);

        $fotoDonaturPath = $request->hasFile('foto_donatur') ? $request->file('foto_donatur')->store('public/kedonaturans') : null;
        $foto_donatur = $fotoDonaturPath ? basename($fotoDonaturPath) : null;

        $getDntr = Kedonaturan::where('email', '=', $request->email)->first();
        if($getDntr){
            return back()->with('fail', 'Email sudah terdaftar!');
        }else{
            Kedonaturan::create([
                'nama_donatur' => $request->nama_donatur,
                'nomor_handphone' => $request->nomor_handphone,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'password' => Hash::make($request->passwordd),
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban,
                'foto_donatur' => $foto_donatur
            ]);
            return redirect()->route('kedonaturan')->with(['message' => 'Donatur berhasil ditambahkan']);
        }
    }

    public function edit_donatur(string $id): View
    {
        $donatur = Kedonaturan::findOrFail($id);
        return view('kedonaturan.edit_kedonaturan', compact('donatur'));
    }

    public function update_donatur(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_donatur' => 'required',
            'email' => 'required|email',
            'foto_donatur' => 'image|mimes:jpeg,jpg,png|max:2048'
        ],
        [
            'nama_donatur.required' => 'Nama donatur harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'foto_donatur.image' => 'Format foto salah!',
            'foto_donatur.max' => 'Ukuran foto terlalu besar'
        ]);

        $donatur = Kedonaturan::findOrFail($id);

        if(Kedonaturan::where('email', '=', $request->email)->where('id_donatur', '!=', $request->id)->first()){
            return back()->with('fail', 'Email sudah terdaftar!');
        } else if(Kedonaturan::where('email', '=', $request->email)->where('id_donatur', '=', $request->id)->first() || Kedonaturan::where('email', '!=', $request->email)->where('id_donatur', '=', $request->id)->first()){
            if ($request->hasFile('foto_donatur')) {
                $foto_donatur = $request->file('foto_donatur');
                $foto_donatur->storeAs('public/kedonaturans', $foto_donatur->hashName());
    
                Storage::delete('public/kedonaturans/' . $donatur->foto_donatur);
    
                if(strlen($request->passwordd) < 8 || strlen($request->passwordd) > 16){
                    if(empty($request->passwordd)){
                        $donatur->update([
                            'nama_donatur' => $request->nama_donatur,
                            'nomor_handphone' => $request->nomor_handphone,
                            'alamat' => $request->alamat,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'email' => $request->email,
                            'pertanyaan' => $request->pertanyaan,
                            'jawaban' => $request->jawaban,
                            'foto_donatur' => $foto_donatur->hashName()
                        ]);
                        return redirect()->route('kedonaturan')->with(['message' => 'Data donatur berhasil diedit']);
                    } else {
                        return back()->with('fail', 'Password harus terdiri dari 8-16 karakter');
                    }
                } else {
                    $donatur->update([
                        'nama_donatur' => $request->nama_donatur,
                        'nomor_handphone' => $request->nomor_handphone,
                        'alamat' => $request->alamat,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->email,
                        'password' => Hash::make($request->passwordd),
                        'pertanyaan' => $request->pertanyaan,
                        'jawaban' => $request->jawaban,
                        'foto_donatur' => $foto_donatur->hashName()
                    ]);
                    return redirect()->route('kedonaturan')->with(['message' => 'Data donatur berhasil diedit']);
                }
            } else {
                if(strlen($request->passwordd) < 8 || strlen($request->passwordd) > 16){
                    if(empty($request->passwordd)){
                        $donatur->update([
                            'nama_donatur' => $request->nama_donatur,
                            'nomor_handphone' => $request->nomor_handphone,
                            'alamat' => $request->alamat,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'email' => $request->email,
                            'pertanyaan' => $request->pertanyaan,
                            'jawaban' => $request->jawaban
                        ]);
                        return redirect()->route('kedonaturan')->with(['message' => 'Data donatur berhasil diedit']);
                    } else {
                        return back()->with('fail', 'Password harus terdiri dari 8-16 karakter');
                    }
                } else {
                    $donatur->update([
                        'nama_donatur' => $request->nama_donatur,
                        'nomor_handphone' => $request->nomor_handphone,
                        'alamat' => $request->alamat,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'email' => $request->email,
                        'password' => Hash::make($request->passwordd),
                        'pertanyaan' => $request->pertanyaan,
                        'jawaban' => $request->jawaban,
                    ]);
                    return redirect()->route('kedonaturan')->with(['message' => 'Data donatur berhasil diedit']);
                }
            }
        } 
    }

    public function hapus_donatur($id): RedirectResponse
    {
        $donatur = kedonaturan::findOrFail($id);
        $donasi = Donasi::where('id_donatur', $id)->get();
        
        Storage::delete('public/kedonaturans/' . $donatur->foto_donatur);
        
        if($donasi->isNotEmpty()){
            foreach ($donasi as $d) {
                $d->delete();
            }
        }
        $donatur->delete();
        return redirect()->route('kedonaturan')->with(['message' => 'Donatur berhasil dihapus']);
    }

    //api mobile
    public function createDonatur(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $validateDonatur = Validator::make($request->all(), [
                'nama_donatur' => 'nullable',
                'nomor_handphone' => 'required',
                'alamat' => 'nullable',
                'jenis_kelamin' => 'nullable',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'pertanyaan' => 'required',
                'jawaban' => 'required'
            ]);

            // Jika validasi gagal, kembalikan pesan error
            if ($validateDonatur->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateDonatur->errors()
                ], 422);
            }

            // Buat pengguna baru
            $donatur = Kedonaturan::create([
                'nama_donatur' => $request->nama_donatur,
                'nomor_handphone' => $request->nomor_handphone,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Enkripsi password
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => $request->jawaban
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'donatur' => $donatur
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create user',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    // Method untuk login pengguna
    public function loginDonatur(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $validateDonatur = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Jika validasi gagal, kembalikan pesan error
            if ($validateDonatur->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateDonatur->errors()
                ], 422);
            }

            // Lakukan proses autentikasi pengguna
            if (!Auth::guard('donatur')->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            // Jika autentikasi berhasil, kembalikan respons dengan token autentikasi
            $donatur = Kedonaturan::where('email', $request->email)->first();

            // Pastikan pengguna ditemukan
            if (!$donatur) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $donatur->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to login user',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    // Method untuk mendapatkan data pengguna dari token
    public function getDntrFromToken()
    {
        $donatur = Auth::user();
    
        if ($donatur) {
            return response()->json([
                'id_donatur' => $donatur->id_donatur,
                'nama_donatur' => $donatur->nama_donatur,
                'nomor_handphone' => $donatur->nomor_handphone,
                'alamat' => $donatur->alamat,
                'jenis_kelamin' => $donatur->jenis_kelamin,
                'email' => $donatur->email,
                'password' => $donatur->password,
                'pertanyaan' => $donatur->pertanyaan,
                'jawaban' => $donatur->jawaban,
            ]);
        } else {
            return response()->json(['error' => 'Donatur tidak ditemukan'], 404);
        }
    } 

    //UpdateProfilController
    public function updateDntr(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_donatur' => 'sometimes|required|string|max:255',
            'nomor_handphone' => 'sometimes|required|string|max:20',
            'jawaban' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // // Temukan pengguna yang sedang login
        $donatur = Auth::user();
        // $donatur = Auth::guard('donatur')->user();

        if (!$donatur instanceof Kedonaturan) {                             
            return response()->json(['message' => 'Donatur tidak ditemukan'], 404);
        }

        // Perbarui data pengguna
        if ($request->has('nama_donatur')) {
            $donatur->nama_donatur = $request->input('nama_donatur');
        }

        if ($request->has('nomor_handphone')) {
            $donatur->nomor_handphone = $request->input('nomor_handphone');
        }

        if ($request->has('alamat')) {
            $donatur->alamat = $request->input('alamat');
        }

        if ($request->has('jawaban')) {
            $donatur->jawaban = $request->input('jawaban');
        }

        $donatur->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $donatur], 200);
    }

    //ForgotPasswordController
    public function resetPsswrd(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'email' => 'required|email',
            'jawaban' => 'required',
            'password' => 'required|min:8', // Validasi password baru
        ]);

        // Cari pengguna berdasarkan email
        $donatur = Kedonaturan::where('email', $request->email)->first();

        // Periksa apakah pengguna ditemukan
        if (!$donatur) {
            return response()->json(['message' => 'Email tidak ditemukan'], 404);
        }

        // Periksa apakah jawaban keamanan sesuai
        if ($request->jawaban === $donatur->jawaban) {
            // Jika jawaban keamanan benar, ubah password pengguna
            $donatur->password = Hash::make($request->password);
            $donatur->save();
            return response()->json(['message' => 'Password berhasil diubah'], 200);
        } else {
            // Jika jawaban keamanan salah
            return response()->json(['message' => 'Jawaban Keamanan Salah, Silahkan cek lagi!'], 400);
        }
    }

    //UbahPasswordController
    public function verifyEmail(Request $request){
        $request->validate(['email' => 'required|email']);
        $donatur= Kedonaturan::where('email', $request->email)->first();

        if ($donatur) {
            return response()->json(['pertanyaan' => $donatur->pertanyaan], 200);
        }

        return response()->json(['message' => 'Email not found'], 404);
    }

    public function verifyAnswer(Request $request){
        $request->validate([
            'email' => 'required|email',
            'jawaban' => 'required'
        ]);
        $donatur = Kedonaturan::where('email', $request->email)->first();
        if ($donatur && $request->jawaban === $donatur->jawaban) {
            return response()->json(['message' => 'Jawaban sesuai'], 200);
        }
        return response()->json(['message' => 'Jawaban tidak sesuai'], 401);

    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);
        $donatur = Kedonaturan::where('email', $request->email)->first();

        if ($donatur) {
            $donatur->password = Hash::make($request->password);
            $donatur->save();
            return response()->json(['message' => 'Password has been reset'], 200);
        }
    }
}
