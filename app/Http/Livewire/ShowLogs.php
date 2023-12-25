<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Messages;
use App\Models\Twin;
use MongoDB\BSON\ObjectId;
use Illuminate\Http\Request;



class ShowLogs extends Component
{
    public $model , $twin;

    // protected $listeners = [
    //     'converssationMessages' => 'converssationMessages' ,
        
    // ];

    public function mount( request $request ){

        $this->twin = Twin::select('twin_external_id','title')
                            ->where("user_id",Auth::user()->id)
                            ->where("id",$request->route('id'))
                            ->first();

    }

    public function render()
    {

        $this->model = Messages::select('botpress_conversation_id','botpress_channel','botpress_createdOn')->where("twin_id",new ObjectId($this->twin->twin_external_id))->groupBy("botpress_conversation_id")->get();

        return view('livewire.logs.show-logs');
    }
   

    public function converssationMessages($id){
 
        // $this->model = Messages::where("botpress_conversation_id",$id)->get();        
        return view('livewire.show-logs.messages');
    }
}
