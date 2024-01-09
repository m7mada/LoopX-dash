<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Twin;
use App\Models\Messages;
use App\Models\Order;
use MongoDB\BSON\ObjectId;
use Carbon\Carbon;



class Dashboard extends Component
{
    public $userTwins , $totalUsage , $lastWeekUsages, $totalConversasions , $lastWeekConversasions , $servedUsers , $servedUsersLastMonth , $twinMessages , $userOrders , $messagesCost;
    public function render()
    {
        $this->userTwins = Twin::where("user_id",Auth::user()->id)
                                ->with("messages",function($query){
                                    $query->where('role','=','assistant');
                                })
                                ->with('files')
                                ->get();

        if( Auth::user()->is_admin ){
            $this->userTwins = Twin::get();
        }

        $this->userTwins->transform(function ($twin) {
            $twin->color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            $twin->messages_count = count($twin->messages) ;
            $twin->messages_cost = $twin->messages->sum("total_cost") ;

            return $twin;
        });


        foreach ($this->userTwins as $twin) {

            $this->messagesCost += Messages::where('role', 'assistant')
                                    ->where('twin_id',$twin->twin_external_id)
                                    ->sum('total_cost');

            $this->totalUsage += Messages::where('twin_id', $twin->twin_external_id)
                                            ->where('role', 'assistant')
                                            ->count();

            $this->lastWeekUsages += Messages::where('twin_id', $twin->twin_external_id)
                                                ->where('role', 'assistant')
                                                ->where('created_at','>',Carbon::now()->subWeek()->startOfWeek())
                                                ->count();

            $this->totalConversasions += count(Messages::where('twin_id', $twin->twin_external_id)
                                                    ->groupBy('botpress_conversation_id')
                                                    ->get());

            $this->lastWeekConversasions += count(Messages::where('twin_id', $twin->twin_external_id)
                                                    ->groupBy('botpress_conversation_id')
                                                    ->where('created_at','>',Carbon::now()->subWeek()->startOfWeek())
                                                    ->get());

            $this->servedUsers += count(Messages::where('twin_id', $twin->twin_external_id)
                                                    ->groupBy('botpress_user_id')
                                                    ->get());


            $this->servedUsersLastMonth += count(Messages::where('twin_id', $twin->twin_external_id)
                                                    ->groupBy('botpress_user_id')
                                                    ->where('created_at','>',Carbon::now()->subWeek()->startOfWeek())
                                                    ->get());

        }

        $this->userOrders = Order::where('payment','=','completed')
                                        ->where('user_id',Auth::user()->id)
                                        ->get();


        return view('livewire.dashboard');
    }
}
