<?php

namespace Tests;

use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Cookie;

class BaseTestCase extends TestCase
{
    protected string $validEmail = "user@user.ru";
    protected string $validPassword = "123456789";
    protected string $invalidEmail = "invalid@dav.ru";
    protected string $invalidPassword = "invalids";
    protected string $validInn = "7707083893";
    protected string $invalidInn = "11111111111";

    protected function fetchXsrfToken()
    {
       return $this->getJson('sanctum/csrf-cookie');
    }

    protected function  getXsrfTokenFromResponse(TestResponse $response)
    {
       $cookie = (collect($response->headers->getCookies())->first(function (Cookie $cookie) {
          return $cookie->getName() === 'XSRF-TOKEN';
       }));
       return $cookie ? $cookie->getValue() : '';
    }
}
