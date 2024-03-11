<?php

namespace Tests\Feature\Api;

use OpenApi\Annotations as OA;
use Tests\TestCase;


/**
 *
 * @OA\Post(
 *      path="/api/registration",
 *      summary="Регистрация тихая",
 *      description="Этот метод позволяет регистрировать пользователя",
 *      tags={"Logic"},
 *      @OA\RequestBody(
 *          description="Данные запроса",
 *          required=true,
 *          @OA\MediaType(
 *               mediaType="multipart/form-data",
 *               @OA\Schema(
 *                   required={"fio", "identification_code", "image1", "image2", "image3"},
 *                   @OA\Property(property="fio", type="string"),
 *                   @OA\Property(property="identification_code", type="string"),
 *                   @OA\Property(property="image1", type="file"),
 *                   @OA\Property(property="image2", type="file"),
 *                   @OA\Property(property="image3", type="file"),
 *               )
 *           )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Успешная регистрация",
 *          @OA\JsonContent(
 *               type="array",
 *               @OA\Items(
 *                    type="object",
 *                    @OA\Property(property="fio", type="string"),
 *                    @OA\Property(property="identification_code", type="string"),
 *                    @OA\Property(property="id", type="string"),
 *                )
 *           )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Ответ сервера что нет нужных данных для регистрации",
 *      )
 *  )
 */


class RegistrationTest extends TestCase
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
