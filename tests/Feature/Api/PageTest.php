<?php

namespace Tests\Feature\Api;

use Illuminate\Http\JsonResponse;
use Tests\TestCase;


/**
 * Получить список всех страниц
 *
 * @return JsonResponse
 *
 * @OA\Get(
 *     path="/api/pages",
 *     summary="Получить список страниц",
 *     description="Этот метод позволяет получить список страниц",
 *     tags={"Pages"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="Список страниц из базы данных",
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
 *                       property="slug",
 *                       type="string"
 *                  ),
 *                  @OA\Property(
 *                       property="text",
 *                       type="string"
 *                  )
 *              )
 *          )
 *     )
 * ),
 *
 * @OA\Get(
 *     path="/api/pages/{page}",
 *     summary="Получить данные одной страницы",
 *     description="Этот метод позволяет получить данные одной страницы",
 *     tags={"Pages"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *       name="page",
 *       in="path",
 *       description="Идентификатор страницы",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Страница по идентификатору из базы данных",
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
 *                        property="slug",
 *                        type="string"
 *                   ),
 *                   @OA\Property(
 *                        property="text",
 *                        type="string"
 *                   )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что страницы с таким идентификатором не существует",
 *     )
 * ),
 * @OA\Post(
 *     path="/api/pages",
 *     summary="Создание новой страницы",
 *     description="Этот метод позволяет создать новую страницу",
 *     tags={"Pages"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *         description="Заголовок",
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "text"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="text", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о странице после создания из базы данных",
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
 *                         property="slug",
 *                         type="string"
 *                    ),
 *                    @OA\Property(
 *                         property="text",
 *                         type="string"
 *                    )
 *          )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания страницы",
 *     )
 * ),
 * @OA\Put(
 *     path="/api/pages/{page}",
 *     summary="Обновление текущей страницы по идентификатору",
 *     description="Этот метод позволяет обновить страницу по идентификатору",
 *     tags={"Pages"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *       name="page",
 *       in="path",
 *       description="Идентификатор страницы",
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
 *             required={"title", "text"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="text", type="string")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Данные о странице после обновления из базы данных",
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
 *                          property="slug",
 *                          type="string"
 *                     ),
 *                     @OA\Property(
 *                          property="text",
 *                          type="string"
 *                     )
 *          )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что страницы с таким идентификатором не существует",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ответ сервера что нет нужных данных для создания страницы",
 *     )
 * ),
 *
 * @OA\Delete(
 *     path="/api/pages/{page}",
 *     summary="Удаление страницы по идентификатору",
 *     description="Этот метод позволяет удалить страницу по идентификатору",
 *     tags={"Pages"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *       name="setting",
 *       in="path",
 *       description="Идентификатор страницы",
 *       required=true,
 *       example="1",
 *       @OA\Schema(
 *         type="integer",
 *       ),
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Ответ что страница удалена",
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Ответ что страницы с таким идентификатором не существует",
 *     )
 * )
 */


class PageTest extends TestCase
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
