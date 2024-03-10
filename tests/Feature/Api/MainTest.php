<?php

namespace Tests\Feature\Api;


use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 *
 * @OA\Info(
 *     version="2.0.0",
 *     title="API",
 *     description="Документация запросов",
 *     @OA\Contact(
 *         email="admin@admin.com",
 *         name="API Support"
 *     )
 * )
 *
 */

class MainTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
