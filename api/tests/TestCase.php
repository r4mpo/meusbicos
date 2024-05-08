<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use GuzzleHttp\Client;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $httpClient;
    protected $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTUxMjg1ODUsImV4cCI6MTcxNTEzMjE4NSwibmJmIjoxNzE1MTI4NTg1LCJqdGkiOiJPeExjM3hrRUdZNkdja3FlIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.qvYnGE0CGHykrd69DX-DoziahLjGE-QhUzr1jyjnHCE'; // Defina o token aqui
}
