<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Models\Account;
use App\Models\AccountPhoto;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function __invoke(RegistrationRequest $request)
    {

        $account = Account::query()
            ->where('identification_code', $request->identification_code)
            ->first();

        if(!$account) {

            $account = new Account();
            $account->fio = $request->fio;
            $account->identification_code = $request->identification_code;
            $account->save();

            $this->storeFile($account, $request->file('image1'));
            $this->storeFile($account, $request->file('image2'));
            $this->storeFile($account, $request->file('image3'));

        }



        return response()->json($account);



    }

    protected function storeFile($account, $file) {


        // Генерируем уникальное имя файла
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Перемещаем файл в директорию для хранения файлов
        $file->move(storage_path('app/public/uploads'), $fileName);

        // Возвращаем путь к загруженному файлу
        $filePath = 'uploads/' . $fileName;

        $accountPhoto = new AccountPhoto();
        $accountPhoto->account_id = $account->id;
        $accountPhoto->image = $filePath;

        $accountPhoto->save();

    }

}
