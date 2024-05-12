<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use GuzzleHttp\Client;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $httpClient;
    protected $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTU0OTE2NDMsImV4cCI6MTcxNTQ5NTI0MywibmJmIjoxNzE1NDkxNjQzLCJqdGkiOiJqWlJDd0M5cUprbGpIMFY5Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.zRCB497F9g0FpgPEcouQKsYI46nyoilT6N0zO9AwXHo'; // Defina o token aqui
}
