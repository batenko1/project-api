<?php

namespace App\Services;

use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class PrepareWordByMarkers
{

    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public static function handle($file, $markers, $data)
    {

        $filePath = storage_path('app/your_word_file.docx');

        // Создание экземпляра TemplateProcessor с указанием пути к файлу
        $templateProcessor = new TemplateProcessor($filePath);

        // Массив с данными для замены
        $replaceData = [
            'marker1' => 'Новый текст для маркера 1',
            'marker2' => 'Новый текст для маркера 2',
            // Добавьте другие маркеры и соответствующие тексты замены, если нужно
        ];

        // Замена маркеров в шаблоне
        foreach ($replaceData as $marker => $replacement) {
            $templateProcessor->setValue($marker, $replacement);
        }

        // Сохранение изменений в файле
        $templateProcessor->saveAs(storage_path('app/modified_word_file.docx'));

        // Опционально: отправка файла пользователю в качестве скачиваемого файла
        return response()->download(storage_path('app/modified_word_file.docx'));

    }

}
