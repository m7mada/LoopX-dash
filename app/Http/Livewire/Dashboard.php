<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Twin;
use App\Models\Messages;
use App\Models\Order;
use MongoDB\BSON\ObjectId;
use Carbon\Carbon;
use DB ;



class Dashboard extends Component
{
    public $userTwins , $totalUsage , $lastWeekUsages, $totalConversasions , $lastWeekConversasions , $servedUsers , $servedUsersLastMonth , $twinMessages , $userOrders , $messagesCost , $customersCridets, $customersTotalMessages , $customersTotalMessagesCost, $customersRemainingCridets;
    public function render()
    {
        $this->userTwins = Twin::where("user_id",Auth::user()->id)
                                ->with("messages",function($query){
                                    $query->where('role','=','assistant');
                                })
                                ->with('files')
                                ->get();

        if( Auth::user()->is_admin ){
            $this->userTwins = Twin::limit(50)->get();
            $this->customersCridets = DB::select("SELECT SUM(order_lines.value) as total_credits FROM order_lines WHERE order_lines.order_id IN ( SELECT id FROM orders WHERE orders.is_paid = 1 AND order_lines.benefit_id = ( SELECT id FROM benefits WHERE benefits.type = 'cridet' ))");

            foreach( $this->userTwins as $customerTwin ){
                $this->customersTotalMessages += Messages::where('twin_id', $customerTwin->twin_external_id)
                                    ->where('role', 'assistant')
                                    ->count();

                $this->customersTotalMessagesCost += $customerTwin->messages->sum("total_cost") ;
            
            }

            // dd($this->customersCridets[0]->total_credits);
            $this->customersRemainingCridets = $this->customersCridets[0]->total_credits - $this->customersTotalMessagesCost ;
        }


        $this->userTwins->transform(function ($twin) {
            $twin->color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            $twin->messages_count = count($twin->messages->where('role','=','assistant')) ;
            $twin->messages_cost = $twin->messages->sum("total_cost") ;

            return $twin;
        });


        $this->totalCridets = DB::select("SELECT SUM(order_lines.value) as total_credits FROM order_lines WHERE order_lines.order_id IN ( SELECT id FROM orders WHERE orders.is_paid = 1 AND orders.user_id = ". Auth::user()->id ." AND order_lines.benefit_id = ( SELECT id FROM benefits WHERE benefits.type = 'cridet' ))");


        //dd($this->totalCridets[0]->total_credits);
        foreach ($this->userTwins as $twin) {


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

        //dd($this->userTwins , $this->totalUsage);
        $this->userOrders = Order::where('is_paid','=','1')
                                        ->where('user_id',Auth::user()->id)
                                        ->get();

        return view('livewire.dashboard');
    }
}
