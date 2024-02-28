<?php

namespace App\Http\Controllers\Api;

class PrepareFilterAction {

    public function __invoke()
    {
        $html = view('entities.blocks.prepare-filter')->render();

        return $html;
    }

}
