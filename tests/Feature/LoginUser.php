<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cookie;

class LoginUser extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    public function test_login_with_valid_credentials_and_remember_me()
    {
        // Buat user dummy
        $user = User::factory()->create([
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        // Kirim request login dengan data valid + remember_me
        $response = $this->post('/login', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'asdasdasd',
            'remember_me' => 'on',
        ]);

        // Pastikan redirect ke dashboard
        $response->assertRedirect('dashboard');

        // Pastikan session berisi loginId dan loginSuccess
        $response->assertSessionHas('loginId', $user->id_user);
        $response->assertSessionHas('loginSuccess', 'Login Berhasil!');

        // Pastikan cookie email dan password diset (tidak 100% bisa dicek isinya, tapi pastikan ada)
        $response->assertCookie('email');
        $response->assertCookie('password');
    }

    public function test_login_with_valid_credentials_without_remember_me()
    {
        $user = User::factory()->create([
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        // Kirim request login tanpa remember_me
        $response = $this->post('/login', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'asdasdasd',
        ]);

        $response->assertRedirect('dashboard');
        $response->assertSessionHas('loginId', $user->id_user);
        $response->assertSessionHas('loginSuccess', 'Login Berhasil!');

        // Pastikan cookie email dan password dihapus (nilai null)
        $response->assertCookieMissing('email');
        $response->assertCookieMissing('password');
    }

    public function test_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        // Kirim login dengan password salah
        $response = $this->from('/login')->post('/login', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'aaasssddd',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('fail', 'Email atau password salah!');
    }

    public function test_login_with_unregistered_email()
    {
        // Kirim login dengan email yang tidak terdaftar
        $response = $this->from('/login')->post('/login', [
            'email' => 'nhcare@gmail.com',
            'passwordd' => 'asdasdasd',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('fail', 'Email belum terdaftar.');
    }

    public function test_login_validation_errors()
    {
        // Kirim request tanpa email dan passwordd
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors([
            'email' => 'Email harus diisi!',
            'passwordd' => 'Password harus diisi!',
        ]);
    }
}
