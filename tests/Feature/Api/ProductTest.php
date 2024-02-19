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
 *     path="/api/products",
 *     summary="Получить список продуктов",
 *     description="Этот метод позволяет получить список продуктов",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="Список продуктов из базы данных",
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
 *                      property="title",
 *                      type="string"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/products/{product}",
 *     summary="Получить данные одного продукта",
 *     description="Этот метод позволяет получить данные одного продукта",
 *     tags={"Products"},
 *     @OA\Parameter(
 *       name="product",
 *       in="path",
 *       description="Идентификатор продукта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Продукт по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что продукта с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/products",
 *     summary="Создание нового продуктак",
 *     description="Этот метод позволяет создать один продукт",
 *     tags={"Products"},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о продукте после создания из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания продукта",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/products/{product}",
 *     summary="Обновление текущего продукта по идентификатору",
 *     description="Этот метод позволяет обновить продукт по идентификатору",
 *     tags={"Products"},
 *     @OA\Parameter(
 *       name="product",
 *       in="path",
 *       description="Идентификатор продукта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о продукте после обновления из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="id",
 *                  type="integer",
 *                  format="int64"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что продукта с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания продукта",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/products/{product}",
 *     summary="Удаление продукта по идентификатору",
 *     description="Этот метод позволяет удалить продукт по идентификатору",
 *     tags={"Products"},
 *     @OA\Parameter(
 *       name="product",
 *       in="path",
 *       description="Идентификатор продукта",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что продукт удален",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что продукт с таким идентификатором не существует",
 *     )
 * )
 */

class ProductTest extends TestCase
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
