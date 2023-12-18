<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Twin; 
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;


class Twins extends Component
{
    use WithFileUploads;

    public $model = Twin::class ;
    public $listTwins = true ;
    public $showForm = false ;
    public $currentStep = 0 ;
    public $addTwins = false ;
    public $files=[], $newFiles = [] ;

    protected $listeners = [
        'addTwins' => 'addTwins' ,
        'insertTwins' => 'insertTwins',
        'editTwins' => 'editTwins',
        'updateTwin' => 'updateTwin',
        'cancelTwins'=>'cancelTwins'
        
    ];

    protected $rules = [
        'model.title' => 'required',
        'model.agent_persona' => 'nullable|max:300',
        'model.agent_instructions' => 'nullable|max:300',
        'model.example_messagesa' => 'nullable|max:300',
        'model.kb_model_name' => 'nullable',
        'model.msgs_model_name' => 'nullable',
        'model.agent_dialect' => 'nullable',
        'model.user_dialect' => 'nullable',
    ];


    public function mount(){
        $this->model = Twin::where("user_id",Auth::user()->id)->get();
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
            $files  = File::query()->where('twin_id',$id)->select('path')->get()->toArray();

            

            $this->showForm = true ;
            $this->currentStep++ ;    

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function insertTwins(){
        $this->validate();

        try{
            $this->model->user_id = Auth::user()->id ;
            $this->model->save();
            $this->addTwins = false ;
            $this->currentStep = 2 ;
            
            session()->flash('success','Twin Created Successfully');

        } catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function updateTwin(){
        $this->validate();

        try{

            $this->model->save();
            $this->currentStep++;
        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function removeFile($fileId){

        $file = File::query()->find($fileId);
        \Storage::disk('s3')->delete($file->getAttributes()['path']);
        $file->delete();
        foreach ($this->files as $key => $file){
            if ($file['id'] == $fileId){
                unset($this->files[$key]);
            }
        }

        $this->emit('refreshComponent');
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
}
