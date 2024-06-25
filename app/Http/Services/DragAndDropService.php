<?php

namespace App\Http\Services;

use App\Models\Option;
use App\Models\Question;
use App\Models\Pilganda;
use App\Models\DragNDrop;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Helpers\Logger;


class DragAndDropService
{
    public function createDragNDrop(Request $request, $questionId, string $key, $id)
    {
        try {
            $optionId = Uuid::uuid7();

            Option::create([
                'id' => $optionId,
                'question_id' => $questionId
            ]);

            $dragdrop = [
                'id' => Uuid::uuid7(),
                'option_id' => $optionId,
                'option_key' => $request['kunci' . $key . '-' . $id],
                'option_value' => $request['jawaban' . $key . '-' . $id]
            ];

            DragNDrop::create($dragdrop);
        } catch(\Exception $e) {
            Logger::errLog('[DRAG N DROP SERVICE]', $e->getMessage());
            throw $e;
        }
    }

    public function updateDragNDrop(Request $request, Option $option, $index)
    {
        try {
            $dragndrop = DragNDrop::where('option_id', '=', $option->id)->first();

            $newData = [
                'option_key' => $request['kunci' . $index . '-' . $request['id']],
                'option_value' => $request['jawaban' . $index . '-' . $request['id']],
            ];

            $dragndrop->fill($newData)->save();


        } catch(\Exception $e) {
            Logger::errLog('[DRAG N DROP SERVICE]', $e->getMessage());
            throw $e;
        }
    }
}
