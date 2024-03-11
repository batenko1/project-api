<?php

namespace Tests\Feature\Api;

use OpenApi\Annotations as OA;
use Tests\TestCase;

/**
 *
 * @OA\Post(
 *      path="/api/create-order",
 *      summary="Создание заказа",
 *      description="Этот метод позволяет создать заказ",
 *      tags={"Logic"},
 *      @OA\RequestBody(
 *          description="Данные запроса",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"account_id", "products"},
 *              @OA\Property(property="account_id", type="number"),
 *              @OA\Property(property="products", type="string", example="[21]")
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Созданный заказ",
 *          @OA\JsonContent(
 *               type="object",
 *               @OA\Property(property="account_id", type="number"),
 *                     @OA\Property(property="price", type="number"),
 *                     @OA\Property(property="fio", type="string"),
 *                     @OA\Property(property="bonuses", type="number"),
 *                     @OA\Property(property="id", type="number"),
 *                     @OA\Property(property="file_contract", type="string"),
 *                     @OA\Property(property="account", type="object",
 *                         @OA\Property(property="id", type="number"),
 *                              @OA\Property(property="fio", type="string"),
 *                              @OA\Property(property="identification_code", type="string"),
 *                              @OA\Property(property="is_verified", type="number")
 *                     )
 *           )
 *      ),
 *     @OA\Response(
 *           response=404,
 *           description="Нету такого аккаунта или товаров",
 *       ),
 *      @OA\Response(
 *          response=422,
 *          description="Ответ сервера что нет нужных данных для входа",
 *      )
 *  )
 */



class CreateOrderTest extends TestCase
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
