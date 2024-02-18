<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use Tests\TestCase;

/**
 * Получить список всех сущностей
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/accounts",
 *     summary="Получить список профилей",
 *     description="Этот метод позволяет получить список аккаунтов",
 *     tags={"Accounts"},
 *     @OA\Response(
 *         response=200,
 *         description="Список аккаунтов из базы данных",
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
 *                      property="fio",
 *                      type="string"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/accounts/{account}",
 *     summary="Получить данные одного аккаунта",
 *     description="Этот метод позволяет получить данные одного аккаунта",
 *     tags={"Accounts"},
 *     @OA\Parameter(
 *       name="account",
 *       in="path",
 *       description="Идентификатор аккаунта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Аккаунт по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="fio",
 *                  type="string"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что аккаунта с таким идентификатором не существует",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/accounts/{account}",
 *     summary="Удаление аккаунта по идентификатору",
 *     description="Этот метод позволяет удалить один аккаунт по идентификатору",
 *     tags={"Accounts"},
 *     @OA\Parameter(
 *       name="account",
 *       in="path",
 *       description="Идентификатор аккаунта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что аккаунт удален",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что аккаунта с таким идентификатором не существует",
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/accounts/{account}/orders",
 *     summary="Метод возвращает заказы для определенного аккаунта",
 *     description="Этот метод позволяет получить список аккаунтов",
 *     tags={"Accounts"},
 *     @OA\Parameter(
 *       name="account",
 *       in="path",
 *       description="Идентификатор аккаунта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Список заказов для аккаунта из базы данных",
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
 *          )
 *              )
 *          )
 *     )
 *
 * )
 */


class AccountTest extends TestCase
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
