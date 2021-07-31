<?php


namespace App\Repositories;


use App\Interfaces\ClientInterface;
use App\Models\Client;
use App\Traits\StatusCode;
use App\Traits\ServerResponse;
use DB;

class ClientRepository implements ClientInterface
{
    use ServerResponse, StatusCode;

    /**
     * This function is used to get a client by ID.
     *
     * @param $id
     *
     */
    public function getClientById($id)
    {
        try {
            $client = Client::withTrashed()->find($id);

            if (!$client) {
                return $this->response(true, null, "Cliente con ID $id no encontrado", self::$StatusNotFound);
            }

            return $this->response(false, $client, "Cliente", self::$StatusOK);
        } catch (\Exception $e) {
            return $this->response(true, null, $e->getMessage(), $e->getCode());
        }
    }

    /**
     * This function is used to save a new client.
     *
     * @param $data
     * @param $token
     *
     */
    public function createClient($data)
    {
        DB::beginTransaction();
        try {
            $client = new Client();
            $client->id = $data['id'];
            $client->name = $data['name'];
            $client->status = 'creado';
            $client->queue = $data['queue'];

            $client->save();

            DB::commit();
            return $this->response(false, $client, "Cliente creado correctamente", self::$StatusCreated);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response(true, null, $e->getMessage(), $e->getCode());
        }
    }

    /**
     * This function is used to update a client.
     *
     * @param $data
     * @param $id
     *
     */
    public function updateClient($data, $id)
    {
        try {
            DB::beginTransaction();
            $client = Client::find($id);
            if (!$client) {
                return $this->response(true, null, "Cliente con ID $id no encontrado", self::$StatusNotFound);
            }

            $client->status = $data['status'];

            $client->save();

            DB::commit();
            return $this->response(false, null, "Cliente actualizado correctamente", self::$StatusNoContent);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response(true, null, $e->getMessage(), $e->getCode());
        }
    }

    /**
     * This function is used to delete a establishment.
     *
     * @param $id
     *
     */
    public function deleteClient($id)
    {
        try {
            DB::beginTransaction();
            $client= Client::find($id);
            if (!$client) {
                return $this->response(true, null, "Cliente con ID $id no encontrado", self::$StatusNotFound);
            }
            $client->delete();
            DB::commit();
            return $this->response(false, null, "Cliente eliminado correctamente", self::$StatusOK);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response(true, null, $e->getMessage(), $e->getCode());
        }
    }
}
