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
 *     path="/api/entities",
 *     summary="Получить список сущностей",
 *     description="Этот метод позволяет получить список сущностей",
 *     tags={"Entities"},
 *     @OA\Response(
 *         response=200,
 *         description="Список сущностей из базы данных",
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
 *     path="/api/entities/{entity}",
 *     summary="Получить данные одной сущности",
 *     description="Этот метод позволяет получить данные одной сущности",
 *     tags={"Entities"},
 *     @OA\Parameter(
 *       name="entity",
 *       in="path",
 *       description="Идентификатор сущности",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Сущность по идентификатору из базы данных",
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
 *         description="Ответ что сущности с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/entities",
 *     summary="Создание новой сущности",
 *     description="Этот метод позволяет создать одну сущность",
 *     tags={"Entities"},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="parent_id", type="integer"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о сущности после ее создания из базы данных",
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
 *              ),
 *              @OA\Property(
 *                  property="parent_id",
 *                  type="int64"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания сущности",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/entities/{entity}",
 *     summary="Обновление текущей сущности по идентификатору",
 *     description="Этот метод позволяет обновить одну сущность по идентификатору",
 *     tags={"Entities"},
 *     @OA\Parameter(
 *       name="entity",
 *       in="path",
 *       description="Идентификатор сущности",
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
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="parent_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о сущности после ее обновления из базы данных",
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
 *              ),
 *              @OA\Property(
 *                  property="parent_id",
 *                  type="int64"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что сущности с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания сущности",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/entities/{entity}",
 *     summary="Удаление текущей сущности по идентификатору",
 *     description="Этот метод позволяет удалить одну сущность по идентификатору",
 *     tags={"Entities"},
 *     @OA\Parameter(
 *       name="entity",
 *       in="path",
 *       description="Идентификатор сущности",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что сущность удалена",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что сущности с таким идентификатором не существует",
 *     )
 * )
 */


class EntityTest extends TestCase
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
