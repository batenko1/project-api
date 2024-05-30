<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Template;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateContractController extends Controller
{
    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function __invoke(Request $request, $templateId, $accountId)
    {
        $data = $request->all();

        $account = Account::query()->findOrFail($accountId);

        $template = Template::query()->findOrFail($templateId);
        $filePath = storage_path('app/public/' . $template->file);
        $replacements = explode(',', $template->variables);

        $resultReplacements = [];

        foreach ($replacements as $key => $item) {

            $item = trim($item);


            if(isset($data[$item])) {
                $resultReplacements[$item] = $data[$item];
            }


            if($item == 'identification_code' || $item == 'inn') {
                $resultReplacements[$item] = $account->identification_code;
            }

        }



        $contract = $this->createContract($filePath, $resultReplacements);


        return response()->json([
            'contract' => asset('storage/'. $contract)
        ]);


    }



    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function createContract($filePath, $replacements): string
    {

        $templateProcessor = new TemplateProcessor($filePath);


        // Заменяем слова в шаблоне
        foreach ($replacements as $search => $replace) {
            $templateProcessor->setValue($search, $replace);
        }


        $path = 'users/' . time() . \Str::random(8) . '.docx';
        $orderContract = storage_path('app/public/' . $path);

        $directoryPath = pathinfo($orderContract, PATHINFO_DIRNAME);

        // Проверяем существование директории
        if (!file_exists($directoryPath)) {
            // Если директория не существует, создаем её
            mkdir($directoryPath, 0755, true); // Второй аргумент - права доступа к директории
        }


        // Сохраняем измененный документ
        $templateProcessor->saveAs($orderContract);

        return $path;

    }
}
