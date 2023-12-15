<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Twin; 
use Auth ;

class Twins extends Component
{

    public $twins, $title, $user_id, $is_active, $agent_persona, $agent_instructions, $example_messagesa, $kb_model_name, $msgs_model_name, $agent_dialect, $user_dialect ;
    public $addTwins = false;
    public $updateTwins = false;
    public $showModale = true ;

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

    public function resetFields(){
        $this->title = $this->is_active = $this->agent_persona = $this->agent_instructions = $this->example_messagesa = $this->kb_model_name = $this->msgs_model_name = $this->agent_dialect = $this->user_dialect = '';

    }

    public function render()
    {
        $this->twins = Twin::where("user_id",Auth::user()->id)->get();

        return view('livewire.twins.twins');
    }

    public function addTwins(){
        $this->resetFields();
    }

    public function storeTwins(){
        $this->validate();

        try{
            Twin::create([
                'title'=>$this->title,
                'user_id'=>Auth::user()->id,
            ]);
            session()->flash('success','Twin Created Successfully');
            $this->resetFields();

        } catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function editTwins($id){
        try{
            $twin = Twin::findOrFail($id);
            if( !$twin ){
                session()->flash('error','Twin not Found !!');
            }else{
                $this->twinId = $twin->id;
            }

        }catch(\Excetion $ex){
            session()->flash('error','Something gose wrong !!');
        } 

    }

    public function updateTwin(){
        $this->validate();

        try{
            Twin::whereId($this->twinId)->update([$request->all()]);

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
