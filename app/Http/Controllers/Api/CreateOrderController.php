<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Order;
use App\Models\Product;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\Exception\CopyFileException;
use PhpOffice\PhpWord\Exception\CreateTemporaryFileException;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateOrderController extends Controller
{
    public function __invoke(Request $request)
    {

       $account = Account::query()->find($request->account_id);
       $productsIds = json_decode($request->products);
       $products = Product::query()->whereIn('id', $productsIds)->get();

       $price = $products->sum('price');


       DB::beginTransaction();

       try {
           $order = new Order();
           $order->account_id = $account->id;
           $order->price = $price;
           $order->fio = $account->fio;
           $order->save();


           foreach ($products as $product) {
               $order->products()->attach($order->id, [
                   'product_id' => $product->id,
                   'price' => $product->price,
                   'values' => '[]'
               ]);
           }

           $template = Template::query()->first();
           $filePath = storage_path('app/public/'. $template->file);
           $replacements = explode(',', $template->variables);

           foreach ($replacements as $key => $item) {
               $replacements[$key] = $order->{$item};
           }

//           $replacements = [
//               'order_id' => $order->id,
//               'fio' => $order->fio,
//               'price' => $order->price
//           ];

           $contract = $this->createContract($filePath, $replacements);
           $order->file_contract = $contract;
           $order->save();


           DB::commit();
       }
       catch (\Exception $e) {
           DB::rollBack();
           dd($e);
       }


       return response()->json($order, 201);

    }


    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function createContract($filePath, $replacements) {

        $templateProcessor = new TemplateProcessor($filePath);

        // Заменяем слова в шаблоне
        foreach ($replacements as $search => $replace) {
            $templateProcessor->setValue($search, $replace);
        }


        $path = 'orders/test.docx';
        $orderContract = storage_path('app/public/'. $path);

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
