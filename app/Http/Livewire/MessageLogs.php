<?php

namespace App\Http\Livewire;

use AWS\CRT\HTTP\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Messages;
use App\Models\Twin;
use App\Models\Conversations ;
use App\Helpers\PotBressHelper;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Log ;



class MessageLogs extends Component
{
    public $model = Twin::class , $twin , $mt_twins = [] , $testVar ,$twinMessages , $inbutMessageToSendToUser , $conversationsGroup, $filters;

    public function mount(Request $request){
        // $pausedConversationIds = Conversations::where('status', 'paused')->pluck('conversation_id')->toArray();

        // dd($pausedConversationIds);

        $this->filters = [
            'search_conversation_id' => request()->search_conversation_id,
            'search_date_from' => request()->search_date_from,
            'search_date_to' => request()->search_date_to,
            'search_chanel' => request()->search_chanel,
            'search_conversation_status' => request()->search_conversation_status
        ];

        $this->model = Twin::where("user_id", Auth::user()->id)
            ->where('id',request()->id)
            // ->with("messages", function ($query) {
            //     $query->limit(5000);

            //     if( request()->search_conversation_id ){
            //        $query->where('botpress_conversation_id', '=', request()->search_conversation_id);
            //     }
            //     // $query->where('botpress_channel', '!=', 'emulator');

            //     if(request()->search_date_from || request()->search_date_to){
            //         $startDate = request()->has('search_date_from') ? Carbon::parse(request()->search_date_from) : now()->subMonth();;
            //         $endDate = request()->has('search_date_to') ? Carbon::parse(request()->search_date_to) : now();
            //         $query->whereBetween('created_at', [$startDate, $endDate]);
            //     }

            //     if( request()->search_chanel ){
            //         $query->where('botpress_integration', '=', request()->search_chanel);
            //     }

            //     // if(request()->search_conversation_status == 'paused'){
            //     //     $pausedConversationIds = Conversations::pluck('conversation_id')->toArray();
            //     //     $query->whereIn('botpress_conversation_id', $pausedConversationIds);
            //     // }
                

            //     $query->orderBy('created_at', 'asc');
            // })
            ->with("files")
            ->with("user")
            ->first();

        if( !$this->model ){
            return redirect()->route('twins') ->with('error', 'Twin not found or you do not have permission to access it.');
        }

        //dd($this->model->messages->limit(10));
        if( request()->conversationId ){
            $this->twin_id = request()->id ;
            $this->botpress_conversation_id = request()->conversationId ;

            $this->mt_twins = Messages::where('botpress_conversation_id', request()->conversationId )->get();
        }
    
    }
    
    public function render()
    {

        return view('livewire.logs.messages');
    }

    public function getMessges($twin_id, $botpress_conversation_id)
    {

        //dd($this->filters);
        $this->model = Twin::where('twin_external_id',$twin_id)
                ->where("user_id", Auth::user()->id)    
            // ->with("messages", function ($query) {
            //     $query->orderBy('created_at', 'asc');
            //     // $query->where('botpress_channel', '!=', 'emulator');
            //     // $query->whereBetween('created_at', [now()->subMonth(), now()]);


            //     if ($this->filters['search_conversation_id']) {
            //         $query->where('botpress_conversation_id', '=', $this->filters['search_conversation_id']);
            //     }

            //     if ($this->filters['search_date_from'] || $this->filters['search_date_to']) {
            //         $startDate = $this->filters['search_date_from'] ? Carbon::parse($this->filters['search_date_from']) : now()->subMonth();
            //         ;
            //         $endDate = $this->filters['search_date_to'] ? Carbon::parse($this->filters['search_date_to']) : now();
            //         $query->whereBetween('created_at', [$startDate, $endDate]);
            //     }

            //     if ($this->filters['search_chanel']) {
            //         $query->where('botpress_integration', '=', $this->filters['search_chanel']);
            //     }
            //})
            
            ->first();


            // Message::where('botpress_conversation_id',$botpress_conversation_id)
            // ->update([
            //     'is_read' => 1,
            // ]);

        $this->twin_id = $twin_id;
        $this->botpress_conversation_id = $botpress_conversation_id;

        $this->mt_twins = Messages::where('twin_id', $twin_id)
                                    ->where('botpress_conversation_id', $botpress_conversation_id)
                                    // ->where('botpress_channel', '!=', 'emulator')
                                    ->when($this->filters['search_chanel'],function($query){
                                        $query->where('botpress_integration', '=', $this->filters['search_chanel']);
                                    })
                                    ->when($this->filters['search_conversation_id'], function ($query) {
                                        $query->where('botpress_conversation_id', $this->filters['search_conversation_id']);
                                    })
                                    ->when($this->filters['search_date_from'] || $this->filters['search_date_to'], function ($query) {
                                        $startDate = $this->filters['search_date_from'] ? Carbon::parse($this->filters['search_date_from']) : now()->subMonth();
                                        $endDate = $this->filters['search_date_to'] ? Carbon::parse($this->filters['search_date_to']) : now();
                                        $query->whereBetween('created_at', [$startDate, $endDate]);
                                    })
                                    ->get();

    
    //    dd(vars: $this->model->messages);
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

        // Log::info($bot->getMessages([
        //     'botId' => $this->model->botbress_bot_id,
        //     'userId' => $this->mt_twins[0]->botpress_user_id,
        //     'conversationId' => $this->botpress_conversation_id,
        //     'tags' => (object) [],
        //     'payload' => (object) []
        // ]));

        //}
        try {


            // \Log::info("api_message",[
            //     'botId'=> $this->model->botbress_bot_id,
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
                'botId' => $this->model->botbress_bot_id,
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

            $this->mt_twins = Messages::where('botpress_conversation_id', $this->botpress_conversation_id)->get();


            $this->inbutMessageToSendToUser = '';
            $this->dispatchBrowserEvent('focusMessageInput');

        } catch (\Excetion $ex) {
            session()->flash('error', 'Something gose wrong !!');
        }

    }


    
}
