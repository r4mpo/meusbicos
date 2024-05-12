<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $httpClient;
    protected $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTU1MDcwMDEsImV4cCI6MTcxNTUxMDYwMSwibmJmIjoxNzE1NTA3MDAxLCJqdGkiOiJSR0tkZjU0Nll6S2hTcGNDIiwic3ViIjoiNSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.cI8Oze9F9NskXXouPUzC08B3IHELXcTU38KBiHGHMpo'; // Defina o token aqui
}
