<?php

namespace Tests\Feature\Api;

use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 *
 * @OA\Post(
 *      path="/api/accept-contract",
 *      summary="Подтверждение контракта",
 *      description="Этот метод позволяет подтвердить контракт",
 *      tags={"Logic"},
 *      @OA\RequestBody(
 *          description="Заголовок",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"order_id", "account_id"},
 *              @OA\Property(property="order_id", type="number"),
 *              @OA\Property(property="account_id", type="number")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Ответ сервера",
 *          @OA\JsonContent(
 *               type="object",
 *               @OA\Property(property="id", type="number"),
 *               @OA\Property(property="account_id", type="number"),
 *               @OA\Property(property="fio", type="number"),
 *               @OA\Property(property="is_agree", type="number"),
 *               @OA\Property(property="status", type="number"),
 *               @OA\Property(property="payment_status", type="number"),
 *               @OA\Property(property="file_contract", type="number"),
 *               @OA\Property(property="price", type="number"),
 *               @OA\Property(property="bonuses", type="number"),
 *               @OA\Property(property="products", type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="number"),
 *                      @OA\Property(property="title", type="string"),
 *                      @OA\Property(property="entity_id", type="number"),
 *                      @OA\Property(property="price", type="number")
 *                  )
 *              )
 *           )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ответ сервера что нет нужных данных для входа",
 *      )
 *  )
 */


class AcceptContractTest extends TestCase
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
