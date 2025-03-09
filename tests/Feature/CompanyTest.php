<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\BaseTestCase;
use Tests\TestCase;

class CompanyTest extends BaseTestCase
{
    public function test_get_companies_valid_user(): void
    {
        $user = User::where('email', $this->validEmail)->first();
        $response = $this
            ->actingAs($user)
            ->get('/api/companies');
        $response->assertStatus(200);
    }

    public function test_create__company_not_authenticated_user_with_sanctum(): void
    {
        $response = $this
            ->post('/api/companies', [
                'inn' => $this->validInn
            ]);
        $response->assertStatus(302);
    }

    public function test_get_companies_not_authenticated_user_with_sanctum(): void
    {
        $response = $this->get('/api/companies');
        $response->assertStatus(302);
    }

    public function test_create_company(): void
    {
        $user = User::where('email', $this->validEmail)->first();
        $response = $this
            ->actingAs($user)
            ->post('/api/companies', [
                'inn' => $this->validInn
            ]);
        $response->assertStatus(200);
    }

    public function test_create_company_valid_inn(): void
    {
        $user = User::where('email', $this->validEmail)->first();
        $response = $this
            ->actingAs($user)
            ->post('/api/companies', [
                'inn' => $this->validInn,
            ]);
        $response->assertStatus(200);
    }

    public function test_create_company_invalid_inn(): void
    {
        $user = User::where('email', $this->validEmail)->first();
        $response = $this
            ->actingAs($user)
            ->post('/api/companies', [
                'inn' => $this->invalidInn,
            ]);
        $response->assertStatus(404);
    }
}
