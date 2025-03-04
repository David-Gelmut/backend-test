<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\ApiTestCase;
use Tests\TestCase;

class LoginTest extends ApiTestCase
{
    public function test_valid_login()
    {
        $response = $this->post('/api/login', [
            'email' => $this->validEmail,
            'password' => $this->validPassword,
        ]);
        $response->assertStatus(200);
    }

    public function test_invalid_login()
    {
        $response = $this->post('/api/login', [
            'email' => $this->invalidEmail,
            'password' => $this->invalidPassword,
        ]);
        $response->assertStatus(401);
    }

    public function test_invalid_email_valid_password()
    {
        $response = $this->post('/api/login', [
            'email' => $this->invalidEmail,
            'password' => $this->validPassword,
        ]);
        $response->assertStatus(401);
    }

    public function test_valid_email_invalid_password()
    {
        $response = $this->post('/api/login', [
            'email' => $this->validEmail,
            'password' => $this->invalidPassword,
        ]);
        $response->assertStatus(401);
    }

    public function test_password_less_than()
    {
        $response = $this->post('/api/login', [
            'email' => $this->validEmail,
            'password' => "1234",
        ]);
        $response->assertStatus(302);
    }

}
