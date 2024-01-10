<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderCridet
 * 
 * @property int $id
 * @property int $order_id
 * @property int $cridet
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models\Base
 */
class OrderCridet extends Model
{
	protected $table = 'order_cridet';

	protected $casts = [
		'order_id' => 'int',
		'cridet' => 'int'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
