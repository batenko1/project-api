<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 * Получить список всех шаблонов
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/templates",
 *     summary="Получить список шаблонов",
 *     description="Этот метод позволяет получить список шаблонов",
 *     tags={"Templates"},
 *     @OA\Response(
 *         response=200,
 *         description="Список шаблонов из базы данных",
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
 *                       property="variables",
 *                       type="string"
 *                  ),
 *                  @OA\Property(
 *                       property="file",
 *                       type="string"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/templates/{template}",
 *     summary="Получить данные одного шаблона",
 *     description="Этот метод позволяет получить данные одного шаблона",
 *     tags={"Templates"},
 *     @OA\Parameter(
 *       name="template",
 *       in="path",
 *       description="Идентификатор шаблона",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Шаблон по идентификатору из базы данных",
 *         @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                   type="object",
 *                   @OA\Property(
 *                       property="id",
 *                       type="integer",
 *                       format="int64"
 *                   ),
 *                   @OA\Property(
 *                       property="title",
 *                       type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="variables",
 *                        type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="file",
 *                        type="string"
 *                   )
 *               )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что шаблона с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/templates",
 *     summary="Создание нового шаблона",
 *     description="Этот метод позволяет создать новый шаблон",
 *     tags={"Templates"},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 required={"title", "key", "file", "variables"},
 *                 @OA\Property(property="title", type="string"),
 *                 @OA\Property(property="key", type="string"),
 *                 @OA\Property(property="variables", type="string"),
 *                 @OA\Property(property="file", type="file")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о шаблоне после создания из базы данных",
 *         @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                   type="object",
 *                   @OA\Property(
 *                       property="id",
 *                       type="integer",
 *                       format="int64"
 *                   ),
 *                   @OA\Property(
 *                       property="title",
 *                       type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="variables",
 *                        type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="file",
 *                        type="string"
 *                   )
 *               )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания шаблона",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/templates/{template}",
 *     summary="Обновление текущего шаблона по идентификатору",
 *     description="Этот метод позволяет обновить шаблон по идентификатору",
 *     tags={"Templates"},
 *     @OA\Parameter(
 *       name="template",
 *       in="path",
 *       description="Идентификатор шаблона",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  required={"title", "key", "file", "variables"},
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="key", type="string"),
 *                  @OA\Property(property="variables", type="string"),
 *                  @OA\Property(property="file", type="file")
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о шаблоне после обновления из базы данных",
 *         @OA\JsonContent(
 *              type="array",
 *              @OA\Items(
 *                   type="object",
 *                   @OA\Property(
 *                       property="id",
 *                       type="integer",
 *                       format="int64"
 *                   ),
 *                   @OA\Property(
 *                       property="title",
 *                       type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="variables",
 *                        type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="file",
 *                        type="string"
 *                   )
 *               )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что шаблона с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания шаблона",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/templates/{template}",
 *     summary="Удаление шаблона по идентификатору",
 *     description="Этот метод позволяет удалить шаблон по идентификатору",
 *     tags={"Settings"},
 *     @OA\Parameter(
 *       name="template",
 *       in="path",
 *       description="Идентификатор шаблона",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что шаблон удален",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что шаблона с таким идентификатором не существует",
 *     )
 * )
 */


class TemplateTest extends TestCase
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
