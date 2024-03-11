<?php

namespace Tests\Feature\Api;

use OpenApi\Annotations as OA;
use Tests\TestCase;

/**
 *
 * @OA\Post(
 *      path="/api/login",
 *      summary="Авторизация",
 *      description="Этот метод позволяет авторизоваться",
 *      tags={"Logic"},
 *      @OA\RequestBody(
 *          description="Заголовок",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"email", "password"},
 *              @OA\Property(property="email", type="string"),
 *              @OA\Property(property="password", type="string")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Bearer token для Api запросов",
 *          @OA\JsonContent(
 *               type="array",
 *               @OA\Items(
 *                    type="object",
 *                    @OA\Property(
 *                        property="token",
 *                        type="string"
 *                    )
 *                )
 *           )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ответ сервера что нет нужных данных для входа",
 *      )
 *  )
 */


class LoginTest extends TestCase
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
