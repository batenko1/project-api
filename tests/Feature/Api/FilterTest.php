<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use Tests\TestCase;


/**
 * Получить список всех фильтров
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/filters",
 *     summary="Получить список фильтров",
 *     description="Этот метод позволяет получить список фильтров",
 *     tags={"Filters"},
 *     @OA\Response(
 *         response=200,
 *         description="Список фильтров из базы данных",
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
 *                  ),
 *                  @OA\Property(
 *                      property="is_default",
 *                      type="boolean"
 *                  ),
 *                  @OA\Property(
 *                      property="is_required",
 *                      type="boolean"
 *                  ),
 *                  @OA\Property(
 *                      property="entity_id",
 *                      type="integer"
 *                  ),
 *                  @OA\Property(
 *                      property="type",
 *                      type="integer"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/filters/types",
 *     summary="Получить список видов фильтров",
 *     description="Этот метод позволяет получить виды фильтров",
 *     tags={"Filters"},
 *     @OA\Response(
 *          response=200,
 *          description="Список видов фильтров",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="title", type="string")
 *          )
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/filters/{filter}",
 *     summary="Получить данные одного фильтра",
 *     description="Этот метод позволяет получить данные одного фильтра",
 *     tags={"Filters"},
 *     @OA\Parameter(
 *       name="filter",
 *       in="path",
 *       description="Идентификатор фильтра",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Фильтр по идентификатору из базы данных",
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
 *                  property="is_default",
 *                  type="boolean"
 *              ),
 *              @OA\Property(
 *                  property="is_required",
 *                  type="boolean"
 *              ),
 *              @OA\Property(
 *                  property="entity_id",
 *                  type="integer"
 *              )
 *
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что фильтра с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/filters",
 *     summary="Создание нового фильтра",
 *     description="Этот метод позволяет создать новый фильтр",
 *     tags={"Filters"},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="entity_id", type="integer"),
 *             @OA\Property(property="is_default", type="boolean"),
 *             @OA\Property(property="is_required", type="boolean"),
 *             @OA\Property(property="type", type="integer"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о фильтре после ее создания из базы данных",
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
 *                  property="entity_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="type",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="is_default",
 *                  type="boolean"
 *              ),
 *              @OA\Property(
 *                  property="is_required",
 *                  type="boolean"
 *              )
 *
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания фильтра",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/filters/{filter}",
 *     summary="Обновление текущего фильтра по идентификатору",
 *     description="Этот метод позволяет обновить один фильтр по идентификатору",
 *     tags={"Filters"},
 *     @OA\Parameter(
 *       name="filter",
 *       in="path",
 *       description="Идентификатор фильтра",
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
 *             @OA\Property(property="entity_id", type="integer"),
 *             @OA\Property(property="is_default", type="integer"),
 *             @OA\Property(property="is_required", type="integer"),
 *             @OA\Property(property="type", type="integer"),
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
 *                  property="entity_id",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="type",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="is_default",
 *                  type="boolean"
 *              ),
 *              @OA\Property(
 *                  property="is_required",
 *                  type="boolean"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что фильтра с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания фильтра",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/filters/{filter}",
 *     summary="Удаление текущего фильтра по идентификатору",
 *     description="Этот метод позволяет удалить один фильтр по идентификатору",
 *     tags={"Filters"},
 *     @OA\Parameter(
 *       name="filter",
 *       in="path",
 *       description="Идентификатор фильтра",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что фильтр удален",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что фильтра с таким идентификатором не существует",
 *     )
 * )
 */


class FilterTest extends TestCase
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
