<?php

namespace Tests\Feature;

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

    public function test_login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'id_user' => 1,
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        $response = $this->post('/loginUser', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'asdasdasd',
        ]);

        $response->assertRedirect('dashboard');

        $response->assertSessionHas('loginId', $user->id_user);
    }

    public function test_login_with_invalid_password()
    {
        $user = User::factory()->create([
            'id_user' => 1,
            'email' => 'nhcoree@gmail.com',
            'password' => Hash::make('asdasdasd'),
        ]);

        $response = $this->from('/loginUser')->post('/loginUser', [
            'email' => 'nhcoree@gmail.com',
            'passwordd' => 'aaasssddd',
        ]);

        $response->assertRedirect('/loginUser');

        $response->assertSessionHas('fail', 'Email atau password salah!');
    }
}
