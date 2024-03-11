<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentAction;
use App\Models\Account;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
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

        if(!$account) {
            abort(404);
        }

        if(!$request->products) {
            abort(404);
        }

        $productsIds = json_decode($request->products);
        $products = Product::query()->whereIn('id', $productsIds)->get();

        $price = $products->sum('price');

        $user = DB::connection('mysql_bonuses')
            ->table('users')
            ->where('identification_code', $account->identification_code)
            ->first();

        $bonuses = 0;

        if ($user) {
            $bonuses = DB::connection('mysql_bonuses')
                ->table('bonuses')
                ->where('user_id', $user->id)
                ->where('type', 'add')
                ->sum('bonuses');
        }


        DB::beginTransaction();

        if ($bonuses > $price) {
            $price = 0;
            $bonuses = $price;
        } elseif ($bonuses && $price > $bonuses) {
            $price = $price - $bonuses;
        }


        try {
            $order = new Order();
            $order->account_id = $account->id;
            $order->price = $price;
            $order->fio = $account->fio;
            $order->bonuses = $bonuses;
            $order->save();


            foreach ($products as $product) {
                $order->products()->attach($order->id, [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'values' => '[]'
                ]);
            }

            $template = Template::query()->first();
            $filePath = storage_path('app/' . $template->file);
            $replacements = explode(',', $template->variables);

            foreach ($replacements as $key => $item) {
                $replacements[$key] = $order->{$item};
            }

            $contract = $this->createContract($filePath, $replacements);
            $order->file_contract = $contract;
            $order->save();

            $percent = Setting::query()->where('key', 'percent_discount')->first();

            $sumDiscount = ($order->price * $percent->value) / 100;

            $user = DB::connection('mysql_bonuses')
                ->table('users')
                ->where('identification_code', $order->account->identification_code)
                ->first();

            if (!$user) {
                $id = DB::connection('mysql_bonuses')
                    ->table('users')
                    ->insertGetId([
                        'identification_code' => $order->account->identification_code
                    ]);

                $user = DB::connection('mysql_bonuses')
                    ->table('users')
                    ->where('id', $id)
                    ->first();
            }


            if ($bonuses) {
                DB::connection('mysql_bonuses')
                    ->table('bonuses')
                    ->insert([
                        'user_id' => $user->id,
                        'bonuses' => $bonuses,
                        'type' => 'remove'
                    ]);
            }

            if ($price) {
                DB::connection('mysql_bonuses')
                    ->table('bonuses')
                    ->insert([
                        'user_id' => $user->id,
                        'bonuses' => $sumDiscount,
                        'type' => 'add'
                    ]);
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }


//        $result = PaymentAction::payment($order, $order->price);


//        return response()->json(compact('result'), 201);
        return response()->json($order, 201);

    }


    /**
     * @throws CopyFileException
     * @throws CreateTemporaryFileException
     */
    public function createContract($filePath, $replacements)
    {

        $templateProcessor = new TemplateProcessor($filePath);

        // Заменяем слова в шаблоне
        foreach ($replacements as $search => $replace) {
            $templateProcessor->setValue($search, $replace);
        }


        $path = 'orders/' . time() . \Str::random(8) . '.docx';
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
