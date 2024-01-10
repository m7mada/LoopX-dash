<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Order[] $orders
 *
 * @package App\Models\Base
 */
class PaymentMethod extends Model
{
	protected $table = 'payment_methods';

	public function orders()
	{
		return $this->hasMany(Order::class, 'payment_methods_id');
	}
}
