<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegistrationRequest;
use App\Models\Account;
use App\Models\AccountPhoto;
use App\Services\TesseractService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function __invoke(RegistrationRequest $request)
    {

//        Account::query()->delete();
        $account = Account::query()
            ->where('identification_code', $request->identification_code)
            ->first();

        if(!$account) {

            $account = new Account();
            $account->fio = $request->fio;
            $account->identification_code = $request->identification_code;
            $account->save();

            $account->photos()->delete();
            $this->storeFile($account, $request->file('image1'));
            $this->storeFile($account, $request->file('image2'));
            $this->storeFile($account, $request->file('image3'));


            $account->load('photos');

            if($account->photos->where('is_verified', 1)->count() == 3) {
                $account->is_verified = 1;
                $account->save();
            }

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

        $tesseract = new TesseractService();

        $result = $tesseract->check($filePath, $account->identification_code);

        if($result) {
            $accountPhoto->is_verified = 1;
            $accountPhoto->save();
        }

    }

}
