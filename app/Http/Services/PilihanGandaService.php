<?php

namespace App\Http\Services;

use App\Models\Option;
use App\Models\Pilganda;
use App\Models\Question;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Helpers\Logger;

class PilihanGandaService
{
    public function createPilgan(Request $request, $questionId, string $letter, $id)
    {
        try {
            $optionId = Uuid::uuid7();

            Option::create([
                'id' => $optionId,
                'question_id' => $questionId
            ]);

            $pilgan = [
                'id' => Uuid::uuid7(),
                'option_id' => $optionId,
                'option_value' => $request['pilihan' . $letter . $id],
                'correct' => $request['kunci' . $id] === $letter
            ];

            Pilganda::create($pilgan);
        } catch(\Exception $e) {
            Logger::errLog('[PILGANDA SERVICE]', $e->getMessage());
            throw $e;
        }
    }

    public function updatePilgan(Request $request, Option $option, $letter)
    {
        try {

            $pilgan = Pilganda::where('option_id', '=', $option->id)->first();

            $newData = [
                'option_value' => $request['pilihan' . $letter . $request['id']],
                'correct' => $request['kunci' . $request['id']] === $letter
            ];

            $pilgan->fill($newData)->save();

        } catch(\Exception $e) {
            Logger::errLog('[PILGANDA SERVICE]', $e->getMessage());
            throw $e;
        }
    }
}
