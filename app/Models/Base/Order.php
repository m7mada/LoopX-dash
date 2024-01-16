<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\OrderCridet;
use App\Models\PackagesPrice;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property int $user_id
 * @property string $serial_number
 * @property string $payment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $messages_ammount
 * @property int|null $payment_methods_id
 * @property int|null $is_paid
 * @property string|null $payment_reference
 * @property string|null $payment_log
 * @property int $net_paid
 * 
 * @property PaymentMethod|null $payment_method
 * @property User $user
 * @property Collection|OrderCridet[] $order_cridets
 * @property Collection|PackagesPrice[] $packages_prices
 *
 * @package App\Models\Base
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'user_id' => 'int',
		'messages_ammount' => 'int',
		'payment_methods_id' => 'int',
		'is_paid' => 'int',
		'net_paid' => 'int'
	];

	public function payment_method()
	{
		return $this->belongsTo(PaymentMethod::class, 'payment_methods_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_cridets()
	{
		return $this->hasMany(OrderCridet::class);
	}

	public function packages_prices()
	{
		return $this->belongsToMany(PackagesPrice::class, 'order_packages_prices', 'order_id', 'package_price_id')
					->withPivot('id', 'expire_time')
					->withTimestamps();
	}
}
