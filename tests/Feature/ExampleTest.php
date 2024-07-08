<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Osteel\OpenApi\Testing\ValidatorBuilder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/api/couriers/1');

        $validator = ValidatorBuilder::fromYaml(storage_path('api-docs/api-test.yaml'))->getValidator();

        $result = $validator->validate($response->baseResponse, '/couriers/1', 'get');
        
        $response->assertTrue($result);
    }
}
