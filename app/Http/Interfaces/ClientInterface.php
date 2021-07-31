<?php


namespace App\Interfaces;


interface ClientInterface
{

    /**
     * Get client by id
     *
     * @param   integer $id
     *
     * @method
     * @access  public
     */
    public function getClientById($id);

    /**
     * Create a new Client
     *
     * @param   array $data
     * @param   string $token
     *
     * @method  POST /client
     * @access  public
     */
    public function createClient($data);

    /**
     * Update a Client
     *
     * @param   array $data
     * @param   integer $id
     *
     * @method
     * @access  public
     */
    public function updateClient($data, $id);

    /**
     * Delete a client
     *
     * @param   integer $id
     *
     * @method
     * @access  public
     */
    public function deleteClient($id);

}
