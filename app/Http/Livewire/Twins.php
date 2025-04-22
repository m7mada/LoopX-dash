<?php

namespace App\Http\Livewire;

use DB;
use Excetion;
use App\Models\File;
use App\Models\Twin;
use Livewire\Component;
use App\Models\Messages;
use App\Models\Conversations;
use MongoDB\BSON\ObjectId;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Helpers\PotBressHelper;
use Str ;
use Unipile\UnipileSDK;
use App\Services\Connectors\Facebook as FacebookConnector; 
use Illuminate\Support\Facades\Request;



class Twins extends Component
{
    use WithFileUploads;

    public $model = Twin::class ;
    public $listTwins = true ;
    public $showForm = false ;
    public $showLogs = false ;
    public $currentStep = 1 ;
    public $addTwins = false ;
    public $files=[], $newFiles = [] ,$twinMessages , $inbutMessageToSendToUser , $authPages;
    public $twin_id;
    public $botpress_conversation_id;
    public $mt_twins = [] ;
    public $selectedData;
    protected $listeners = [
        'addTwins' => 'addTwins' ,
        'insertTwins' => 'insertTwins',
        'editTwins' => 'editTwins',
        'updateTwin' => 'updateTwin',
        'cancelTwins'=>'cancelTwins',
        'showTwinConverssations'=>'showTwinConverssations',
        'showMessageNew' => 'getMessges',
        'sendMessageToUser'=>'sendMessageToUser',

    ];

    protected $rules = [
        'model.title' => 'required',
        'model.agent_persona' => 'nullable',
        'model.agent_instructions' => 'nullable',
        'model.example_messages' => 'nullable',
        'model.kb_model_name' => 'required',
        'model.msgs_model_name' => 'nullable',
        'model.agent_dialect' => 'required',
        'model.user_dialect' => 'nullable',
        'model.is_active' => 'nullable',
        'model.creativity_temperature'=>'nullable',

        'model.integrations_settings' => 'nullable',
        'model.custom_settings' => 'nullable',
        'model.handover_settings' => 'nullable',

        'model.botbress_bot_id' => 'nullable',
        'model.botbress_integration_key' => 'nullable',
        'model.botbress_workspace_id' => 'nullable',
        'model.user_id' => 'nullable',


    ];


    public function mount($id = null ){


        if( isset($id) ){
            $this->twin_id = $id ;
        }
   
        $this->model = Twin::where("user_id",Auth::user()->id)
                            // ->with("messages",function($query){
                            //     $query->where('role','=','assistant');
                            // })
                            ->with("files")
                            ->with("user")
                            ->get();

        if( Auth::user()->is_admin ){
            //$this->model = Twin::with("files")->with("user")->get();
        }
    }

    public function resetFields(){
        $this->model = new Twin();
    }

    public function render(){

        if( isset($this->twin_id) && $this->currentStep == 1 ){

            // dd("asdfasdf");
            try{
                $this->listTwins = false ;
                $this->model = Twin::find($this->twin_id);
                $this->model->api_token = "***** ".substr($this->model->api_token,-4);
                $this->showForm = true ;

                // $this->currentRoute = Request::route()->getName();
                // if( $this->currentRoute == "twin-callback" ){
                //     $this->code = Request::query('code');

                //     if( isset( $this->code ) ){
                //         $this->currentStep = 5 ;
                //     }
                // }
                $this->authPages = Request::query('pages');

                if( isset( $this->authPages ) ){

                    // dd(session('auth_pages'));
                    $this->authPages = session('auth_pages') ;
                    $this->currentStep = 5 ;
                    // $this->showFacebookMessengerAuthPages(  $this->code ) ;
                }
    
            }catch(\Excetion $ex){
                session()->flash('error','Something gose wrong !!');
            }

        }
        $this->listTwins = true ;
        return view('livewire.twins.twins');
    }

    public function addTwins(){
        $this->resetFields();

        $this->showForm = true ;
        $this->addTwins = true ;
        $this->currentStep = 1 ;
    }

    public function editTwins($id){
        $this->resetFields();


        try{
            
            $this->model = Twin::find($id);
            $this->model->api_token = "***** ".substr($this->model->api_token,-4);

            $this->showForm = true ;
            $this->currentStep++ ;

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function insertTwins(){
        $this->validate();

        try{
            $token = Str::random(60);
            $this->model->twin_external_id = new ObjectId() ;
            $this->model->user_id = Auth::user()->id ;
            $this->model->forceFill([
            'api_token' => hash('sha256', $token), 
            ]);
            $this->model->save();
            $this->addTwins = false ;
            $this->currentStep = 2 ;

            session()->flash('success','Twin Created Successfully');

        } catch(Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function updateTwin(){
        $this->validate();

        try{
            $this->currentStep++;

            ini_set('max_execution_time', 10000);


            if( $this->currentStep == 3 ){

                $files  = File::query()->where('twin_id',$this->model->id)->select('path')->get()->toArray();
                $filesToSend  = [] ;
                foreach ( $files as $fileToSend){
                    $filesToSend[] = $fileToSend['path'];
                }

                if( ! empty( $filesToSend ) ){
                    $r = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ])->post(config('app.django_url').'/api/create-db',[
                        'files' => $filesToSend,
                        'twin_id' => $this->model->twin_external_id,
                    ]);
                } 


            }

            if( $this->currentStep == 4){

                // if( $this->model->botbress_bot_id == null ){
                //     $bot = new PotBressHelper;
                //     $bot = $bot->createBot(['name'=>$this->model->title,'payload'=>[]]);
                //     $this->model->botbress_bot_id = $bot['bot']['id'];
                // }
            }

            $this->model->save();
            


        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function removeFile($fileId){

        $fileToDelete = File::query()->find($fileId);
        \Storage::disk('s3')->delete($fileToDelete->getAttributes()['path']);
        $fileToDelete->delete();
        foreach ($this->files as $key => $file){
            if ($file['id'] == $fileId){
                unset($this->files[$key]);
            }
        }
    }

    public function updatedNewFiles(){
        foreach ($this->newFiles as $file){
            $newFile = File::create([
                'path' => $file->store('x_coach/files/'. $this->model->id , 's3') ,
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize(),
                'twin_id' => $this->model->id ,
            ]);
            $this->files[] = $newFile;
        }
        $this->newFiles = [] ;
    }

    public function cancelTwins(){
        $this->resetFields();
    }

    public function deleteTwins($id){
        try{
            Twin::find($id)->delete();
            session()->flash('success','Twin Deleted Successfully !!');

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function showTwinConverssations($id){
        $this->resetFields();

        try{
            $this->model = Twin::with("messages")->with('messages.isPauseConversation')->find($id);
            $this->showLogs = true ;
        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function getMessges($twin_id, $botpress_conversation_id)
    {

        $this->twin_id = $twin_id;
        $this->botpress_conversation_id = $botpress_conversation_id;

        $this->mt_twins = Messages::where('twin_id', $twin_id)->where('botpress_conversation_id', $botpress_conversation_id)->get();

        $this->dispatchBrowserEvent('selectConversation');

    }

    public function playPauseConversation($conversationId){
        $conversation = Conversations::where('conversation_id',$conversationId)->get();
        if(count($conversation) > 0){
            $conversation = Conversations::where('conversation_id',$conversationId)->delete();
        }else{
            $conversation = Conversations::insert(['conversation_id'=>$conversationId]);
        }

        $this->mt_twins = Messages::where('twin_id', $this->twin_id)->where('botpress_conversation_id', $conversationId)->get();

    }

    public function sendMessageToUser(){

        if( ! $this->inbutMessageToSendToUser ) return ;

        //dd($this->mt_twins->where('botpress_conversation_id', $this->botpress_conversation_id)->whereNotNull('botpress_user_out_id')->count());
        // $userOutId = $this->mt_twins->where('botpress_conversation_id', $this->botpress_conversation_id)->whereNotNull('botpress_user_out_id')->where('role','assistant');

        $bot = new PotBressHelper($this->model);

        //if( ! $userOutId->count() ){

        //     dd([
        //     'botId' => $this->model->botbress_bot_id,
        //     'userId' => $this->mt_twins[0]->botpress_user_id,
        //     'conversationId' => $this->botpress_conversation_id,
        //     'tags' => (object) [],
        //     'payload' => (object) []
        // ]);
            $outgoingUserId = collect($bot->getMessages([
                'botId' => $this->model->botbress_bot_id,
                'userId' => $this->mt_twins[0]->botpress_user_id,
                'conversationId' => $this->botpress_conversation_id,
                'tags' => (object) [],
                'payload' => (object) []
            ])['messages'])->firstWhere('direction', 'outgoing') ;

            //dd( $bot['userId'] );

            \Log::info($bot->getMessages([
                'botId' => $this->model->botbress_bot_id,
                'userId' => $this->mt_twins[0]->botpress_user_id,
                'conversationId' => $this->botpress_conversation_id,
                'tags' => (object) [],
                'payload' => (object) []
            ]));

        //}
        try{


            // \Log::info("api_message",[
            //     'botId'=> $this->mt_twins[0]->botpress_bot_id,
            //     'userId'=> $this->mt_twins[0]->botpress_user_id,
            //     'conversationId'=>$this->botpress_conversation_id,
            //     'type'=> 'choice',
            //     'tags'=> (object) [],
            //     'payload'=>[
            //          "text"=> $this->inbutMessageToSendToUser ,
            //          "options"=>[]
            //     ]
            // ]);
            
            $bot = $bot->sendMessage([
                'botId'=> $this->mt_twins[0]->botpress_bot_id,
                'userId'=> $outgoingUserId['userId'],
                'conversationId'=>$this->botpress_conversation_id,
                'type'=> 'choice',
                'tags'=> (object) [],
                'payload'=>[
                     "text"=> $this->inbutMessageToSendToUser ,
                     "options"=>[]
                ]
            ]);


            $message = new Messages([
                "role" => "assistant",
                "content" => $this->inbutMessageToSendToUser,
                "twin_id" => $this->twin_id,
                "botpress_user_id" => $this->mt_twins[0]->botpress_user_id,
                "botpress_bot_id" => $this->mt_twins[0]->botpress_bot_id,
                "botpress_conversation_id" => $this->botpress_conversation_id,
                "botpress_messageId" => "internal".rand(6,8),
                "botpress_integration" => 'console',
                "botpress_channel" => null,
                "botpress_eventId" => null,
                "botpress_eventType" => null,
                "botpress_createdOn" => null,
                "created_at" => now(),
                "event_payload" => (object) [],
                "botpress_user_out_id" => "123456789s",

            ]);

            $message->save();

            $this->mt_twins = Messages::where('twin_id', $this->twin_id)->where('botpress_conversation_id', $this->botpress_conversation_id)->get();


            $this->inbutMessageToSendToUser = '';
            $this->dispatchBrowserEvent('focusMessageInput');

        } catch (\Excetion $ex) {
            session()->flash('error', 'Something gose wrong !!');
        }

    }

    public function updateApiToken(){
        $token = Str::random(60);
        $twin = $this->model ;
        $twin->forceFill([
            'api_token' => hash('sha256', $token), 
        ])->save();
        
    }

    public function getApiToken(){
        $this->model->api_token = $this->model->api_token ;
    }

    public function initUnipile(){
        $this->currentStep = 5 ;


        // curl --request GET --url https://api11.unipile.com:14100/api/v1/accounts --header 'X-API-KEY:m5MTkqt7.qk/xoTPS1inpItzQ8/VHzaFTDAfHkFVFUYxGYv+JimI=' --header 'accept: application/json'


        $baseUri = 'https://api11.unipile.com:14100/api/v1/accounts';
        $token = 'm5MTkqt7.qk/xoTPS1inpItzQ8/VHzaFTDAfHkFVFUYxGYv+JimI=';
        $unipileSDK = new UnipileSDK($baseUri, $token);
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    
        // dd(url('connectorCallback'));
        $linkAccount = $unipileSDK->Account->createHostedLink(
            'PT1H',
            'My User ID',
            url('successConnection'),
            $actual_link.'?status=fail',
            url('connectorCallback'),
            '',
            '*'
        );

        $this->connectionLink = $linkAccount['url'];

        $linkedAccounts = $unipileSDK->Account->list();
        $this->linkedAccounts = $linkedAccounts;
        // dd($this->linkedAccounts['items']);

        // dd($accounts);
    }

    public function connectFacebookMessenger( FacebookConnector $facebookConnector){
        // dd($this->twin_id);
        
        $facebookConnector->connect( $this->twin_id ) ;
    }

    public function showFacebookMessengerAuthPages( FacebookConnector $facebookConnector , Request $request , $id){
        $this->pages = $facebookConnector->callback( Request::query('code') ) ;

        $this->pages = [
            [
                'access_token' => 'EAAZAQZA5mdy1QBO8zoEuWB0eZA02EqnZBUPA1wA1zztRKKsMtZBVistVZB9dE9kekCPlZCOkbdwtpcjWLUjgR2uBkIyNV2kmz4933nxUaoZCbnldmQ3iJydePgXHGyC1DYqy6mNgVNn15YBL8W5fGu8ve48Q4VQ ▶',
                'category' => 'Software Company',
                'category_list' => [], // The "[▶]" indicates an empty array
                'name' => 'Genudo',
                'id' => '121454467723162',
                'tasks' => [], // The "[▶]" indicates an empty array
            ],
            [
                'access_token' => 'EAAZAQZA5mdy1QBO2o0SGLQ9arsUZBHT2Fl9mQsxNouVc5jdHA1T17jZBA21BQrgcw2wFmsINxR1jPeTZCyYvnM2OKgYjd3VlGeCXmhlWNESXaKXCbcvzvK4J38Sf5Yt2jJZCLZCfrmVzmNVEUjgvQ4JOQUMJAcM ▶',
                'category' => 'Software Company',
                'category_list' => [], // The "[▶]" indicates an empty array
                'name' => '360Code',
                'id' => '575375045831855',
                'tasks' => [], // The "[▶]" indicates an empty array
            ],
        ];
        session(['auth_pages' => $this->pages ]);




        
        // if($this->pages['error']){
        //     return redirect(url('/twin/'.$id )) ;            
        // }
        return redirect(url("/twin/".$id."/?pages=1") ) ;
    }

    public function selectFbPage( FacebookConnector $facebookConnector ,  $page ) {
        $connectedPage = $facebookConnector->confirmPage( $page ) ;

        dd($connectedPage);
    }
}
