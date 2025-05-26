<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */

    use RefreshDatabase;

    // Test halaman login bisa diakses
    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Test login dengan kredensial valid
    public function test_login_with_valid_credentials()
    {
        // Buat user dummy
        $user = User::factory()->create([
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),  // password terenkripsi
        ]);

        // Kirim POST request login
        $response = $this->post('/login', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'asdasdasd',
        ]);

        // Pastikan redirect ke dashboard
        $response->assertRedirect('dashboard');

        // Pastikan session menyimpan loginId (sesuaikan dengan session yang dipakai)
        $response->assertSessionHas('loginId', $user->id_user);
    }

    // Test login dengan password salah
    public function test_login_with_invalid_password()
    {
        $user = User::factory()->create([
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'aaasssddd',
        ]);

        // Pastikan kembali ke halaman login
        $response->assertRedirect('/login');

        // Pastikan session berisi pesan error login gagal
        $response->assertSessionHas('fail', 'Email atau password salah!');
    }
}
