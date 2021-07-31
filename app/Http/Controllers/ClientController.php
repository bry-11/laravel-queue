<?php


namespace App\Http\Controllers;


use App\Interfaces\ClientInterface;
use App\Jobs\ExampleJob;
use App\Jobs\Job;
use App\Traits\ServerResponse;
use App\Traits\StatusCode;
use App\Traits\Utils;
use Illuminate\Http\Request;
use Validator;

class ClientController extends Controller
{
    use ServerResponse, StatusCode;

    private $clientInterface;

    public function __construct(ClientInterface $clientInterface){
        $this->clientInterface = $clientInterface;
    }

    /**
     * This function is used to validate fields to create and update client
     *
     * @param $inputs
     *
     */
    private function validateFields($inputs){

        $rules = array(
            'id' => 'integer|unique:clients|min:0',
            'name' => 'required|max:100|regex:/^[\p{L}\p{M}0-9\s-]+$/u',
            'queue' => 'required|integer|min:1|max:2',
        );

        $messages = array(
            'id.required' => 'El campo ID es requerido',
            'id.integer' => 'El campo ID debe ser un valor numérico',
            'id.unique' => 'El ID ya se encuentra ingresado',
            'id.min' => 'El ID debe ser un valor positivo',
            'name.required' => 'El campo Nombre es requerido',
            'name.max' => 'El campo Nombre debe tener máximo :max caracteres',
            'name.regex' => 'El campo Nombre debe ser solo letras',
            'queue.required' => 'El Número de la cola es requerido',
            'queue.integer' => 'El Número de la cola debe ser un valor numérico',
            'queue.min' => 'El Número de la cola debe ser mínimo :min',
            'queue.max' => 'El Número de la cola debe ser máximo :max',
        );

        $validator = Validator::make($inputs, $rules, $messages);
        return $validator;
    }

    /**
     * Store a newly created client in DB.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createClient(Request $request)
    {
        $inputs = $request->all();
        $validator = $this->validateFields($inputs);

        $generalMsg = "Ocurrió un error en los campos enviados del formulario";
        if ($validator->fails()) {
            \Log::info($validator->errors());
            return $this->error($generalMsg, $validator->errors(), self::$StatusBadRequest);
        }

        $client = $this->clientInterface->createClient($inputs);
        if($client["error"]){
            return $this->error($client["message"], null, $client["code"]);
        }

        if ($inputs['queue'] == 1){
            $this->dispatch((new ExampleJob($client['data'], $this->clientInterface))->onQueue('queue1')->delay(120));
        } else{
            $this->dispatch((new ExampleJob($client['data'], $this->clientInterface))->onQueue('queue2')->delay(180));
        }

        return $this->success("Cliente creado correctamente", $client['data'], $client["code"]);
    }
}
