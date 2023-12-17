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

    protected $listeners = [
        'addTwins' => 'addTwins' ,
        'storeTwins' => 'storeTwins',
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
            $this->showForm = true ;
            $this->currentStep++ ;    

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function storeTwins(){
        $this->validate();

        try{
            // Twin::create([
            //     'title'=>$this->title,
            //     'user_id'=>Auth::user()->id,
            // ]);
            $this->model->save();
            
            session()->flash('success','Twin Created Successfully');
            $this->resetFields();

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
