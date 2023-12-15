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

    public $model;
    public $listTwins = true ;
    public $updateTwins = false ;
    public $currentStep = 0 ;

    protected $listeners = [
        'addTwins' => 'addTwins' ,
        'storeTwins' => 'storeTwins',
        'editTwins' => 'editTwins',
        'updateTwin' => 'updateTwin',
        'cancelTwins'=>'cancelTwins'
        
    ];

    protected $rules = [
        'title' => 'required',
        //'agent_persona' => 'required',
        // 'agent_instructions' => 'required',
        // 'example_messagesa' => 'required',
        // 'kb_model_name' => 'required',
        // 'msgs_model_name' => 'required',
        // 'agent_dialect' => 'required',
        // 'user_dialect' => 'required',
    ];

    public function mount(){
        $this->model = Twin::class ;
    }

    public function resetFields(){
        $this->model = new Twin();
    }

    public function render()
    {
        $this->listTwins = true ;
        $this->model = Twin::where("user_id",Auth::user()->id)->get();

        return view('livewire.twins.twins');
    }

    public function addTwins(){
        $this->resetFields();
        $this->updateTwins = true ;
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

    public function editTwins($id){
        $this->resetFields();


        try{
            $this->model = Twin::find($id);

            $this->title = $this->model->title ;

            $this->updateTwins = true ;
            $this->currentStep++ ;

   
            

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function updateTwin(){
        $this->validate();

        try{
            $this->model->save();
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
