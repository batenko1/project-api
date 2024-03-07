<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();


        $products = Product::query()
            ->when(count($data), function ($query) use ($data) {

                foreach ($data as $key => $value) {

                    if($key == 'search') {
                        $query->where(function ($query) use($value) {
                            $query->where('title', 'LIKE', '%'. $value .'%')
                                ->orWhereHas('values', function ($query) use($value) {
                                    $query->where('value', 'LIKE', '%'. $value .'%');
                                });
                        });
                    }
                    else {
                        $filterId = \Str::replace('filter_', '', $key);


                        if (strpos($key, 'filter') !== false) {
                            $query->whereHas('values', function ($query) use ($value, $filterId) {

                                if(is_array($value)) {
                                    $query->whereIn('value', $value)
                                        ->where('filter_id', $filterId);
                                }
                                else {
                                    $query->where('value', $value)
                                        ->where('filter_id', $filterId);
                                }

                            });
                        }
                    }
                }

            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($products);
    }
}
