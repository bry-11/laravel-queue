<?php

namespace App\Jobs;

use App\Interfaces\ClientInterface;
use App\Models\Client;

class ExampleJob extends Job
{
    protected $client;
    protected $clientInterface;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Client $client, ClientInterface $clientInterface)
    {
        $this->client = $client;
        $this->clientInterface = $clientInterface;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $array = array(
            'status' => 'Atendido',
        );

        $this->clientInterface->updateClient($array, $this->client->id);
        \Log::info('Cliente procesado ' . $this->client->id);

        $this->clientInterface->deleteClient($this->client->id);
        \Log::info('Cliente eliminado ' . $this->client->id);
    }
}

