<?php

namespace App\Helpers;

use App\Traits\Utils;
use Validator;


class ValidateFields
{
    use Utils;

    /**
     * This function is used to validate fields to create and update client
     *
     * @param $inputs
     *
     */
    private function validateFields($inputs){

        $rules = array(
            'id' => 'required|integer',
            'name' => 'required|max:64',
            'queue' => 'required|integer',
        );

        $messages = array(
            'id.required' => 'El campo ID es requerido',
            'id.integer' => 'El campo ID debe ser un valor numérico',
            'name.required' => 'El campo Nombre es requerido',
            'name.max' => 'El campo Nombre debe tener máximo :max caracteres',
            'queue.required' => 'El Número de la cola es requerido',
            'queue.integer' => 'El Número de la cola debe ser un valor numérico',
        );

        $validator = Validator::make($inputs, $rules, $messages);
        return $validator;
    }
}
