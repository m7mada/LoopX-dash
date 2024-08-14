<?php

namespace App\Http\Livewire;

use AWS\CRT\HTTP\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Messages;
use App\Models\Twin;
use App\Helpers\PotBressHelper;


class MessageLogs extends Component
{
    public $model = Twin::class , $twin , $mt_twins = [] , $testVar ,$twinMessages , $inbutMessageToSendToUser;

    // protected $listeners = [
    //     'getMessges' => 'getMessges',
    // ];


    public function mount(){

        $this->model = Twin::where("user_id", Auth::user()->id)
            ->where('id',request()->id)
            ->with("messages", function ($query) {
                if( request()->conversationId ){
                    $query->where('botpress_conversation_id', '=', request()->conversationId);
                }
                $query->where('role', '=', 'assistant');
            })
            ->with("files")
            ->with("user")
            ->first();

        if( request()->conversationId ){
            $this->twin_id = request()->id ;
            $this->botpress_conversation_id = request()->conversationId ;

            $this->mt_twins = Messages::where('botpress_conversation_id', request()->conversationId )->get();
        }


        if (Auth::user()->is_admin) {
            //$this->model = Twin::where('id',request()->id)->with("files")->with("user")->first();
        }

    

        // $groupedData = \DB::connection('mongodb')->collection('twins_messages')
        //     ->raw(function ($collection) {
        //         return $collection->aggregate([
        //             // Step 1: Match documents where twin_id equals the specific value
        //             //['$match' => ['twin_external_id' => $this->model->twin_external_id]],

        //             // Step 2: Sort the documents by created_at in descending order
        //             ['$sort' => ['created_at' => -1]],

        //             // Step 3: Group by botpress_conversation_id
        //             [
        //                 '$group' => [
        //                     '_id' => '$botpress_conversation_id',
        //                     'items' => [
        //                         '$push' => '$$ROOT'  // Push the entire document into the items array
        //                     ]
        //                 ]
        //             ]
        //         ]);
        // });

        // $groupedCollection = collect($groupedData);
        // dd($groupedCollection);
    
    }
    
    public function render()
    {

            // $this->model = Twin::query()
            //                 ->with("messages",function ($query) {
            //                     $query->orderByCreatedAt('creaddted_at', 'desc');
            //                 })
            //                 ->with('messages.isPauseConversation')
            //                 ->find(request()->id);
        //dd($this->model);

        return view('livewire.logs.messages');
    }

    public function getMessges($twin_id, $botpress_conversation_id)
    {

        // $this->model = Twin::where('twin_external_id',$twin_id)
        //     ->with("messages", function ($query) {
        //         if( request()->conversationId ){
        //             dd("asdfasdf");
        //         }
        //         //$query->orderByCreatedAt('creaddted_at', 'desc');
        //     })
        //     ->with('messages.isPauseConversation')
        //     ->first();


            // Message::where('botpress_conversation_id',$botpress_conversation_id)
            // ->update([
            //     'is_read' => 1,
            // ]);

        $this->twin_id = $twin_id;
        $this->botpress_conversation_id = $botpress_conversation_id;

        $this->mt_twins = Messages::where('twin_id', $twin_id)->where('botpress_conversation_id', $botpress_conversation_id)->get();

    
       // dd($this->model);
        //$this->dispatchBrowserEvent('selectConversation');

    }

    public function playPauseConversation($conversationId)
    {
        $conversation = Conversations::where('conversation_id', $conversationId)->get();
        if (count($conversation) > 0) {
            $conversation = Conversations::where('conversation_id', $conversationId)->delete();
        } else {
            $conversation = Conversations::insert(['conversation_id' => $conversationId]);
        }

        $this->mt_twins = Messages::where('twin_id', $this->twin_id)->where('botpress_conversation_id', $conversationId)->get();

    }

    public function sendMessageToUser()
    {

        if (!$this->inbutMessageToSendToUser)
            return;

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
        ])['messages'])->firstWhere('direction', 'outgoing');

        //dd( $bot['userId'] );

        \Log::info($bot->getMessages([
            'botId' => $this->model->botbress_bot_id,
            'userId' => $this->mt_twins[0]->botpress_user_id,
            'conversationId' => $this->botpress_conversation_id,
            'tags' => (object) [],
            'payload' => (object) []
        ]));

        //}
        try {


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
                'botId' => $this->mt_twins[0]->botpress_bot_id,
                'userId' => $outgoingUserId['userId'],
                'conversationId' => $this->botpress_conversation_id,
                'type' => 'choice',
                'tags' => (object) [],
                'payload' => [
                    "text" => $this->inbutMessageToSendToUser,
                    "options" => []
                ]
            ]);


            $message = new Messages([
                "role" => "assistant",
                "content" => $this->inbutMessageToSendToUser,
                "twin_id" => $this->twin_id,
                "botpress_user_id" => $this->mt_twins[0]->botpress_user_id,
                "botpress_bot_id" => $this->mt_twins[0]->botpress_bot_id,
                "botpress_conversation_id" => $this->botpress_conversation_id,
                "botpress_messageId" => "internal" . rand(6, 8),
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


    
}
