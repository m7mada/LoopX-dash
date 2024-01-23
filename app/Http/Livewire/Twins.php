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


class Twins extends Component
{
    use WithFileUploads;

    public $model = Twin::class ;
    public $listTwins = true ;
    public $showForm = false ;
    public $showLogs = false ;
    public $currentStep = 0 ;
    public $addTwins = false ;
    public $files=[], $newFiles = [] ,$twinMessages;
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
        'showMessageNew' => 'getMessges'

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
        'model.creativity_temperature'=>'nullable'
    ];


    public function mount(){
        $this->model = Twin::where("user_id",Auth::user()->id)
                            ->with("messages",function($query){
                                $query->where('role','=','assistant');
                            })
                            ->with("files")
                            ->get();

        if( Auth::user()->is_admin ){
            $this->model = Twin::get();
        }
    }

    public function resetFields(){
        $this->model = new Twin();
    }

    public function render(){
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

            $this->showForm = true ;
            $this->currentStep++ ;

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        }

    }

    public function insertTwins(){
        $this->validate();

        try{
            $this->model->twin_external_id = new ObjectId() ;
            $this->model->user_id = Auth::user()->id ;
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

            $this->model->save();
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

    }

    public function playPauseConversation($conversationId){
        $conversation = Conversations::where('id',$conversationId)->get();
        if(count($conversation) > 0){
            $conversation = Conversations::where('id',$conversationId)->delete();
        }else{
            $conversation = Conversations::insert(['id'=>$conversationId]);
        }
    }


}
