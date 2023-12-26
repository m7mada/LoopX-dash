<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Messages;
use App\Models\Twin;
use MongoDB\BSON\ObjectId;
use Illuminate\Http\Request;

class MessageLogs extends Component
{
    public $model , $twin ;

    // protected $listeners = [
    //     'converssationMessages' => 'converssationMessages' ,
        
    // ];
    
    public function mount(){
    
        $this->twin = Twin::select('twin_external_id','title')
                            //->where("user_id",Auth::user()->id)
                            ->where("id",19)
                            ->first();
    
    }
    
    public function render()
    {
    
        $this->model = Messages::select('botpress_conversation_id','botpress_channel','botpress_createdOn')->where("twin_id",$this->twin->twin_external_id)->groupBy("botpress_conversation_id")->get();

        dd($this->model);
    
       return view('livewire.message-logs');
    }
    
    public function converssationMessages(){
        dd('ttdtdt');
    }
}
