<?php

namespace App\Http\Services;

use App\Helpers\Logger;
use App\Models\Option;

class OptionService
{
    public function deleteOption(Option $option)
    {
        try {
            $option->delete();
        } catch(\Exception $e) {
            Logger::errLog('OPTION SERVICE', $e->getMessage());
            throw $e;
        }
    }
}
