<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Auth ;
use App\Models\Twin;
use App\Models\TempRecivedMessages;
use Carbon\Carbon;
use Exception ;
use Log ;

class ThirdPartyApiController extends Controller
{

    /**
     * Base URL for the 3rd party API
     * @var string
     */
    // protected $baseUrl = 'https://api.botpress.cloud/v1/chat/';

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

        try{
            $twin = Twin::find(Auth::guard('twins')->user()->id);

            $requiredFields = [
                'id',
                'botpress_webhook_link',
                'botpress_access_token',
                'botbress_workspace_id',
                'botbress_bot_id',
                'botbress_integration_key'
            ];

            // Check for missing fields
            $missingFields = array_filter($requiredFields, fn($field) => empty ($twin->$field));

            if (!empty($missingFields)) {
                $missingFieldsList = implode(', ', array_map(fn($field) => ucfirst(str_replace('_', ' ', $field)), $missingFields));

                return response()->json(['error' => "Not a Twin Or Missing integrations setings :  ".str_replace('Botpress','',$missingFieldsList)], 403);
            }

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
                ],
            ];


            $params['conversationId'] = "conv_".$twin->id.$params['conversationId'] ;
            try{
                $sentTime = Carbon::now();
                $options['body'] = json_encode($params);
                $response = $client->request("post", $apiUrl, $options);
            }catch(Exception $e){
                return response()->json(['error' => "An error occurred"], 500);
            }

            if ($response->getStatusCode() === 200) {
                // $data = json_decode($response->getBody(), true);
                sleep(7);

                $tryContainer = 0 ;
                while($tryContainer < 15 ) {
                    $messageReply = TempRecivedMessages::where('res.webhook', $twin->botpress_webhook_link)->where("res.conversationId", $params['conversationId'])->where('created_at', '>', $sentTime)->get();


                    if ($messageReply->isNotEmpty()) {
                        // Map through the collection to remove un needed fields
                        $filteredMessages = $messageReply->map(function ($message) {
                            $messageArray = $message->toArray();
                            unset($messageArray['res']['botpressUserId']);
                            unset($messageArray['res']['botpressMessageId']);
                            unset($messageArray['res']['botpressConversationId']);
                            unset($messageArray['res']['webhook']);
                            return $messageArray;
                        });




                        TempRecivedMessages::where('res.webhook', $twin->botpress_webhook_link)->where("res.conversationId", $params['conversationId'])->where('created_at', '>', $sentTime)->delete();
                        
                        return response()->json($filteredMessages);
                    }

                    sleep(2);
                    $tryContainer++ ;
                }
                return response()->json(['error' => "Didn't recieve a response"]);


            } else {
                return response()->json(['error' => "Request Error"], $response->getStatusCode());
            }

        }catch(Exception $e){
            return response()->json(['error' => "An error occurred"], 500);
        }
    }

    public function reciveMessages(Request $request){

        $twin = Twin::where('botpress_webhook_link',$request->webhook)->get();

        if( $twin->isNotEmpty() ){

            TempRecivedMessages::create(["res" => $request->all()]);
            return true;

        }else{
            return response()->json(['error' => "Twin Not Found"], 400); 
        }


    }

    public function listTempMessages(){


        // $messageReply = TempRecivedMessages::where('res.webhook', "https://webhook.botpress.cloud/7dc6e6f8-8bf6-4194-ae28-0caac4f21e63")->limit(10)->get();

        // if ($messageReply->isNotEmpty()) {
        //     // Map through the collection to remove specified fields
        //     $filteredMessages = $messageReply->map(function ($message) {
        //         $messageArray = $message->toArray();
        //         unset($messageArray['res']['botpressUserId']);
        //         unset($messageArray['res']['botpressMessageId']);
        //         unset($messageArray['res']['botpressConversationId']);
        //         unset($messageArray['res']['webhook']);
        //         return $messageArray;
        //     });

        //     return response()->json($filteredMessages);
        // }
        dd(TempRecivedMessages::latest()->limit(10)->get());

        // dd($messageReply = TempRecivedMessages::where('res.webhook', "https://webhook.botpress.cloud/d98b5a30-b3b8-4e76-91ba-a1ddfff75693")->where("res.conversationId","conversationId 104")->get());
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

    public function listConversationMessages(Request $request)
    {
        $twin = Twin::find(Auth::guard('twins')->user()->id);
        $apiUrl = $apiUrl = "https://api.botpress.cloud/v1/chat/messages"; //. $twin->botpress_chat_webhook_id . "/conversations";

        $requiredFields = [
            'id',
            'botpress_webhook_link',
            'botpress_access_token',
            'botbress_workspace_id',
            'botbress_bot_id',
            'botbress_integration_key'
        ];

        // Check for missing fields
        $missingFields = array_filter($requiredFields, fn($field) => empty ($twin->$field));

        if (!empty($missingFields)) {
            $missingFieldsList = implode(', ', array_map(fn($field) => ucfirst(str_replace('_', ' ', $field)), $missingFields));

            return response()->json(['error' => "Not a Twin Or Missing integrations setings :  " . str_replace('Botpress', '', $missingFieldsList)], 403);
        }

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer " . $twin->botpress_access_token,
                'x-workspace-id' => $twin->botbress_workspace_id,
                'x-bot-id' => $twin->botbress_bot_id,
                'x-integration-id' => $twin->botbress_integration_key,
            ],
        ];

        $params = $request->all();

        $options['body'] = json_encode($params);

        $response = $client->request("get", $apiUrl, $options);

        if ($response->getStatusCode() === 200) {
            return response()->json(json_decode($response->getBody(), true));
        } else {
            return response()->json(['error' => "There is an error getting messages"], $response->getStatusCode());
        }
    }

    public function listConversations(Request $request)
    {
        $twin = Twin::find(Auth::guard('twins')->user()->id);
        $apiUrl = $apiUrl = "https://api.botpress.cloud/v1/chat/conversations";

        $requiredFields = [
            'id',
            'botpress_webhook_link',
            'botpress_access_token',
            'botbress_workspace_id',
            'botbress_bot_id',
            'botbress_integration_key'
        ];

        // Check for missing fields
        $missingFields = array_filter($requiredFields, fn($field) => empty ($twin->$field));

        if (!empty($missingFields)) {
            $missingFieldsList = implode(', ', array_map(fn($field) => ucfirst(str_replace('_', ' ', $field)), $missingFields));

            return response()->json(['error' => "Not a Twin Or Missing integrations setings :  " . str_replace('Botpress', '', $missingFieldsList)], 403);
        }

        $client = new Client();
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer " . $twin->botpress_access_token,
                'x-workspace-id' => $twin->botbress_workspace_id,
                'x-bot-id' => $twin->botbress_bot_id,
                'x-integration-id' => $twin->botbress_integration_key,
            ],
        ];

        $params = $request->all();

        $options['body'] = json_encode($params);

        $response = $client->request("get", $apiUrl, $options);

        if ($response->getStatusCode() === 200) {
            return response()->json(json_decode($response->getBody(), true));
        } else {
            return response()->json(['error' => "There is an error getting conversations"], $response->getStatusCode());
        }
    }


    public function proxyFBAppTobootPress(Request $request){


        Log::info($request->entry[0]['id']);



        if( $request->hub_mode = 'subscribe' && $request->hub_verify_token == "mGyrZthKwYrHLgkkF0d3h7e8Fs3DBfZeVOY1j0VbXePGBgI07e2l8wzLuhgQJIa" ){

            return response($request->hub_challenge, '200');
        }
        // $targetUrl = 'https://api.example.com/endpoint';

        if( $v=1 ){
            $targetUrl = 'https://webhook.botpress.cloud/d0a651f7-3bf2-4272-a2f6-bd90e18960fd';

        }else{
            $targetUrl = 'https://webhook.botpress.cloud/6984d2fb-9571-4de6-aced-d83a53deffd5';

        }

        // // Get all query parameters from the incoming request
        // $queryParams = $request->query();

        // // Get all request data (for POST, PUT, PATCH requests)
        // $requestData = $request->all();

        // // Get the request method
        // $method = $request->method();

        // // Forward the request to the target URL
        // $response = Http::withHeaders($request->header())
        //     ->$method($targetUrl, $method === 'GET' ? $queryParams : $requestData);

        // // Return the response from the target endpoint
        // return response($response->body(), $response->status())
        //     ->withHeaders($response->headers());

    }
}
