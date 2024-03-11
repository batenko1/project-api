<?php

namespace Tests\Feature\Api;

use OpenApi\Annotations as OA;
use Tests\TestCase;

/**
 *
 * @OA\Post(
 *      path="/api/payment/{orderId}",
 *      summary="Создание платежа",
 *      description="Этот метод позволяет создать платеж по идентификатору заказа",
 *      tags={"Logic"},
 *      @OA\Parameter(
 *        name="orderId",
 *        in="path",
 *        description="Идентификатор заказа",
 *        required=true,
 *        example="1",
 *        @OA\Schema(
 *          type="integer",
 *        ),
 *      ),
 *      @OA\Response(
 *      response=200,
 *      description="Ответ сервера",
 *      @OA\MediaType(
 *          mediaType="text/html",
 *          @OA\Schema(
 *              type="string",
 *              example="<html><body><h1>Hello, World!</h1></body></html>"
 *          )
 *      )
 *  ),
 *      @OA\Response(
 *          response=422,
 *          description="Ответ сервера что нет нужных данных для входа",
 *      )
 *  )
 */


class PaymentTest extends TestCase
{

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
