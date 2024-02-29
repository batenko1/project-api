<?php

namespace App\Services;

use thiagoalessio\TesseractOCR\TesseractOCR;

class TesseractService {

    public function check($image, $code) {
        $imagePath = storage_path('app/public/'. $image);

        // Преобразование изображения в черно-белый формат
        $bwImagePath = storage_path('app/public/bw_image.jpg');
        $this->convertToBlackAndWhite($imagePath, $bwImagePath);

        // Создание экземпляра TesseractOCR с указанием пути к черно-белому изображению
        $ocr = new TesseractOCR($bwImagePath);

        // Указание языковых моделей (английский, русский и цифры)
        $ocr->lang('rus', 'eng', 'digits');
        $ocr->psm(5);
//        $ocr->psm(6);

        // Выполнение распознавания текста
        $text = $ocr->executable(env('TESSERACT_PATH'))->run();
//        $text = $ocr->executable('/opt/homebrew/Cellar/tesseract/5.3.4/bin/tesseract')->run();

        $text = \Str::replace(' ', '', $text);
        $text = preg_replace('/\r?\n/', '', $text);
        // Вывод распознанного текста

        if(str_contains($text, $code)) {
            return true;
        }

        return false;
//        echo $text;
    }

    private function convertToBlackAndWhite($inputImagePath, $outputImagePath)
    {
//        // Загрузка изображения
//        $image = imagecreatefromjpeg($inputImagePath);
//
//        // Преобразование изображения в черно-белый формат
//        imagefilter($image, IMG_FILTER_GRAYSCALE);
//        imagefilter($image, IMG_FILTER_CONTRAST, -100);
//
//        // Сохранение черно-белого изображения
//        imagejpeg($image, $outputImagePath);
//
//        // Освобождение памяти, занимаемой изображением
//        imagedestroy($image);

        $imageInfo = getimagesize($inputImagePath);
        $imageType = $imageInfo[2];

        // Загрузка изображения в зависимости от формата
        if ($imageType == IMAGETYPE_JPEG) {
            $image = imagecreatefromjpeg($inputImagePath);
        } elseif ($imageType == IMAGETYPE_PNG) {
            $image = imagecreatefrompng($inputImagePath);
        } else {
            // Обработка других форматов изображений, если необходимо
            return;
        }

        $newWidth = imagesx($image) * 3;
        $newHeight = imagesy($image) * 3;
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));

        imagefilter($image, IMG_FILTER_SMOOTH, 7);

//        // Преобразование изображения в черно-белый формат
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        imagefilter($image, IMG_FILTER_CONTRAST, -100); // рабочее для jpg


        $processedImagePath = 'processed_image.png';
        imagepng($resizedImage, $processedImagePath);

        // Сохранение черно-белого изображения в формате PNG
        imagepng($resizedImage, $outputImagePath);

        // Освобождение памяти, занимаемой изображением
        imagedestroy($image);
    }



    public function convertToMonochrome($imagePath) {
        $image = imagecreatefromjpeg($imagePath);
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        imagefilter($image, IMG_FILTER_CONTRAST, -100);
        imagefilter($image, IMG_FILTER_THRESHOLD, 127);
        return $image;
    }

// 2. Уменьшение яркости и повышение контрастности
    public function adjustBrightnessAndContrast($image) {
        imagefilter($image, IMG_FILTER_BRIGHTNESS, -20);
        imagefilter($image, IMG_FILTER_CONTRAST, 20);
        return $image;
    }

// 3. Разбивка нужных областей скана на отдельные изображения по сетке
    public function splitIntoGrid($image, $rows, $cols) {
        $width = imagesx($image);
        $height = imagesy($image);
        $cellWidth = $width / $cols;
        $cellHeight = $height / $rows;
        $images = array();
        for ($row = 0; $row < $rows; $row++) {
            for ($col = 0; $col < $cols; $col++) {
                $x = $col * $cellWidth;
                $y = $row * $cellHeight;
                $cell = imagecrop($image, ['x' => $x, 'y' => $y, 'width' => $cellWidth, 'height' => $cellHeight]);
                $images[$row][$col] = $cell;
            }
        }
        return $images;
    }

}
