<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 * Получить список всех настроек
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/settings",
 *     summary="Получить список настроек",
 *     description="Этот метод позволяет получить список настроек",
 *     tags={"Settings"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Список настроек из базы данных",
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
 *                       property="key",
 *                       type="string"
 *                  ),
 *                  @OA\Property(
 *                       property="value",
 *                       type="string"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/settings/{setting}",
 *     summary="Получить данные одной настройки",
 *     description="Этот метод позволяет получить данные одной настройки",
 *     tags={"Settings"},
 *     @OA\Parameter(
 *       name="setting",
 *       in="path",
 *       description="Идентификатор настройки",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Настройка по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                       property="id",
 *                       type="integer",
 *                       format="int64"
 *                   ),
 *                   @OA\Property(
 *                       property="title",
 *                       type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="key",
 *                        type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="value",
 *                        type="string"
 *                   )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что настройки с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/settings",
 *     summary="Создание новой настройки",
 *     description="Этот метод позволяет создать новую настройку",
 *     tags={"Settings"},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "key", "value"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="key", type="string"),
 *             @OA\Property(property="value", type="string"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о настройке после создания из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                        property="id",
 *                        type="integer",
 *                        format="int64"
 *                    ),
 *                    @OA\Property(
 *                        property="title",
 *                        type="string"
 *                    ),
 *                    @OA\Property(
 *                         property="key",
 *                         type="string"
 *                    ),
 *                    @OA\Property(
 *                         property="value",
 *                         type="string"
 *                    )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания настройки",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/settings/{setting}",
 *     summary="Обновление текущей настройки по идентификатору",
 *     description="Этот метод позволяет обновить настройку по идентификатору",
 *     tags={"Settings"},
 *     @OA\Parameter(
 *       name="setting",
 *       in="path",
 *       description="Идентификатор настройки",
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
 *             required={"title", "key", "value"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="key", type="string"),
 *             @OA\Property(property="value", type="string"),
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о настройке после обновления из базы данных",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                         property="id",
 *                         type="integer",
 *                         format="int64"
 *                     ),
 *                     @OA\Property(
 *                         property="title",
 *                         type="string"
 *                     ),
 *                     @OA\Property(
 *                          property="key",
 *                          type="string"
 *                     ),
 *                     @OA\Property(
 *                          property="value",
 *                          type="string"
 *                     )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что настройки с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания настройки",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/settings/{setting}",
 *     summary="Удаление настройки по идентификатору",
 *     description="Этот метод позволяет удалить настройку по идентификатору",
 *     tags={"Settings"},
 *     @OA\Parameter(
 *       name="setting",
 *       in="path",
 *       description="Идентификатор настройки",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что настройка удалена",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что настройки с таким идентификатором не существует",
 *     )
 * )
 */


class SettingTest extends TestCase
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
