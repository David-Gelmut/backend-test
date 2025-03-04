<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ApiTestCase;
use Tests\TestCase;

class RegisterTest extends ApiTestCase
{
    public function test_valid_register(): void
    {
        $response = $this->post('/api/register', [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => $this->validPassword,
            'password_confirmation' => $this->validPassword,
        ]);
        $response->assertStatus(201);
    }

    public function test_passwords_dont_match(): void
    {
        $response = $this->post('/api/register', [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => $this->validPassword,
            'password_confirmation' => $this->invalidPassword,
        ]);
        $response->assertStatus(302);
    }

    public function test_email_exists(): void
    {
        $response = $this->post('/api/register', [
            'name' => fake()->name,
            'email' => $this->validEmail,
            'password' => $this->validPassword,
            'password_confirmation' => $this->validPassword,
        ]);
        $response->assertStatus(302);
    }

    public function test_valid_email_invalid_password()
    {
        $response = $this->post('/api/register', [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => "123",
            'password_confirmation' => "123",
        ]);
        $response->assertStatus(302);
    }
}
