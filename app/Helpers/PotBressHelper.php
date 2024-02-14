<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PotBressHelper 
{

    private $client ;
    private $endPoint;
    private $token ;
    private $workspace ;

    public function __construct($twin)
    {
        $this->client = new Client();
        $this->endPoint = "https://api.botpress.cloud";        
        $this->token = ($twin->botbress_integration_key)? $twin->botbress_integration_key : config("app.botbress_token");
        $this->workspace = ($twin->botbress_workspace_id)? $twin->botbress_workspace_id : config("app.botbress_workspace_id");
    }

    public function createBot(array $data)
    {
        try {
            $response = $this->client->post($this->endPoint.'/v1/admin/bots', [
                'json' => $data,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'x-workspace-id' => $this->workspace,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            \Log::error("Botpress API error: " . $e->getMessage());
            return ['error' => 'Failed to create bot.'];
        }
    }

    public function listBots(){
        try {

            $response = $this->client->get($this->endPoint .'/v1/admin/bots', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'x-workspace-id' => $this->workspace ,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            \Log::error("Botpress API error: " . $e->getMessage());
            return ['error' => 'Failed to list bot.'];
        }

    }

    public function sendMessage($data)
    {
        try {

            $response = $this->client->post($this->endPoint . '/v1/chat/messages', [
                'json'=>$data,
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'x-workspace-id' => $this->workspace,
                    'x-bot-id'=>$data['botId'],
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            \Log::error("Botpress API error: " . $e->getMessage());
            return ['error' => 'Failed to send Message.'];
        }

    }
}