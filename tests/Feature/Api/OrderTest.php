<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 * Получить список всех сущностей
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/orders",
 *     summary="Получить список заказов",
 *     description="Этот метод позволяет получить список заказов",
 *     tags={"Orders"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Список заказов из базы данных",
 *         @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                  type="object",
 *                  @OA\Property(
 *                      property="id",
 *                      type="integer",
 *                      format="int64"
 *                  ),
 *                  @OA\Property(
 *                      property="account_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="fio",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="is_agree",
 *                      type="boolean"
 *                  ),
 *                  @OA\Property(
 *                      property="status",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="payment_status",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="file_contract",
 *                      type="string"
 *                  ),
 *
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/orders/{order}",
 *     summary="Получить данные одного заказа",
 *     description="Этот метод позволяет получить данные одного сущности",
 *     tags={"Orders"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *       name="order",
 *       in="path",
 *       description="Идентификатор заказа",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Заказ по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                      property="id",
 *                      type="integer",
 *                      format="int64"
 *                  ),
 *                  @OA\Property(
 *                      property="account_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="fio",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="is_agree",
 *                      type="boolean"
 *                  ),
 *                  @OA\Property(
 *                      property="status",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="payment_status",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="file_contract",
 *                      type="string"
 *                  ),
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что заказа с таким идентификатором не существует",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/orders/{order}",
 *     summary="Удаление заказа по идентификатору",
 *     description="Этот метод позволяет удалить заказ по идентификатору",
 *     tags={"Orders"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *       name="order",
 *       in="path",
 *       description="Идентификатор заказа",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что заказ удален",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что заказа с таким идентификатором не существует",
 *     )
 * )
 */

class OrderTest extends TestCase
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
