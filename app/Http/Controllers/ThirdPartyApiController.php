<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth ;
use App\Models\Twin;
use App\Models\TempRecivedMessages;
use Carbon\Carbon;

class ThirdPartyApiController extends Controller
{

    /**
     * Base URL for the 3rd party API
     * @var string
     */
    protected $baseUrl = 'https://api.botpress.cloud/v1/chat/';

    public function __invoke(Request $request, $endpoint)
    {
        return $this->proxy($request, $endpoint); 
    }

    /**
     * Handle requests to the proxy endpoint.
     *
     * @param Request $request
     * @param string $endpoint The desired API endpoint
     * @return \Illuminate\Http\JsonResponse
     */
    public function proxy(Request $request, $endpoint)
    {
        $twin = Twin::find(Auth::guard('twins')->user()->id);
        // Allowed endpoints
        if (!in_array($endpoint, ['493a36f2-ecec-4bae-a9eb-c46aa282e044','messages','conversations'])) { 
            return response()->json(['error' => 'Invalid endpoint'], 400);
        }

        $params = $request->all();

        $apiUrl = $this->baseUrl . $endpoint;

        $method = $request->method(); 

        //try {
            $client = new Client();
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer bp_pat_HpiWv9lErmO8O1bN8e1rRRKgJltaKBCBtL0d" ,//$request->header('Authorization'),
                    'x-workspace-id' => $twin->botbress_workspace_id,
                    'x-bot-id' => $twin->botbress_bot_id,
                    'x-integration-id'=> $twin->botbress_integration_key,
                    'conversationId' => $request->header('conversationId'),

                ],
            ];

            //dd($$request->header);
            switch ($method) {
                case 'GET':
                    //$options['query'] = $params;
                    $options['body'] = json_encode($params);
                    break;
                case 'POST':
                    $options['body'] = json_encode($params);
                    break;
            }

            //dd($options['body']);
            $response = $client->request($method, $apiUrl, $options);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                return response()->json($data);
            } else {
                return response()->json(['error' => $response->getReasonPhrase()], $response->getStatusCode());
            }
        // } catch (RequestException $e) {
        //     return response()->json(['error' => 'Error fetching data'], 500);
        // }
    }

    public function sendMessage( Request $request){

        $twin = Twin::find(Auth::guard('twins')->user()->id);

        $params = $request->all();

        $apiUrl = $twin->botpress_webhook_link ;// Something like this "https://webhook.botpress.cloud/d98b5a30-b3b8-4e76-91ba-a1ddfff75693";

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer ". $twin->bootpress_access_token,
                'x-workspace-id' => $twin->botbress_workspace_id,
                'x-bot-id' => $twin->botbress_bot_id,
                'x-integration-id' => $twin->botbress_integration_key,
                'conversationId' => $request->header('conversationId'),
                'x-user-key'=>$request->header('user-key'),

            ],
        ];


        $options['body'] = json_encode($params);
        $response = $client->request("post", $apiUrl, $options);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            sleep(15);
            $messageReply = TempRecivedMessages::where('res.webhook', $twin->botpress_webhook_link)->wehre("res.conversationId", $request->header('conversationId'))->get();
            return response()->json($messageReply);
        } else {
            return response()->json(['error' => $response->getReasonPhrase()], $response->getStatusCode());
        }
    }

    public function reciveMessages(Request $request){

        TempRecivedMessages::create(["res"=>$request->all()]);

        return true ;
    }

    public function listTempMessages(){

        dd(TempRecivedMessages::get());

    }

    public function createChatUser( Request $request ){
        $twin = Twin::find(Auth::guard('twins')->user()->id);
        $apiUrl = "https://chat.botpress.cloud/".$twin->botpress_chat_webhook_id."/users";
        // Something like this "https://chat.botpress.cloud/f3717f50-d549-459a-a48c-2e8e4a31a207/users";

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];
        $params = $request->all();

        $options['body'] = json_encode($params);

        $response = $client->request("post", $apiUrl,$options);

        if ($response->getStatusCode() === 200) {
            return response()->json(json_decode($response->getBody(), true));
        } else {
            return response()->json(['error' => $response->getReasonPhrase()], $response->getStatusCode());
        }
    }

    public function createConversation( Request $request ){
        $twin = Twin::find(Auth::guard('twins')->user()->id);
        $apiUrl = $apiUrl = "https://chat.botpress.cloud/" . $twin->botpress_chat_webhook_id . "/conversations";
        // Something like this "https://chat.botpress.cloud/f3717f50-d549-459a-a48c-2e8e4a31a207/users";

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-user-key' => $request->header('user-key'),
            ],
        ];
        $params = $request->all();

        $options['body'] = json_encode($params);

        $response = $client->request("post", $apiUrl, $options);

        if ($response->getStatusCode() === 200) {
            return response()->json(json_decode($response->getBody(), true));
        } else {
            return response()->json(['error' => $response->getReasonPhrase()], $response->getStatusCode());
        }
    }
}
