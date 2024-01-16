<?php

namespace App\Models;

use App\Models\Base\Order as BaseOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseOrder
{
    use HasFactory;
    public $fillable = [
        'name',
        'phone',
        'pakedge_id',
        'user_id',
        'serial_number',
        'payment_methods_id',
        'is_paid',
		'net_paid' ,
    ];


    public function user(){
        return $this->belongsTo(User::class ,'user_id','id');
    }

    public function pakedge(){
        return $this->belongsTo(Packages::class,'pakedge_id','id');
    }


    public function generateSerialNumber()
    {
        // Generate a random number (adjust the length as needed)
        $randomNumber = rand(1000, 99999);

        // Combine with a prefix or any other logic you may need


        return $randomNumber;
    }

    public static function boot()
    {
        parent::boot();

        // Listen for the creating event to generate the serial number before saving
        static::creating(function (Order $order) {
            $order->serial_number = $order->generateSerialNumber();
        });
    }
}
