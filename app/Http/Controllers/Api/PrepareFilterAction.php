<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class PrepareFilterAction {

    public function __invoke(Request $request)
    {
        $name = $request->name ?? '';
        $html = view('entities.blocks.prepare-filter', compact('name'))->render();

        return $html;
    }

}
