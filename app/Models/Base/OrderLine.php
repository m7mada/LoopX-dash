<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Benefit;
use App\Models\Order;
use App\Models\PackagesPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderLine
 * 
 * @property int $id
 * @property int $order_id
 * @property int $benefit_id
 * @property int|null $referance_package_id
 * @property int|null $value
 * @property Carbon|null $expire_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Benefit $benefit
 * @property Order $order
 * @property PackagesPrice|null $packages_price
 *
 * @package App\Models\Base
 */
class OrderLine extends Model
{
	protected $table = 'order_lines';

	protected $casts = [
		'order_id' => 'int',
		'benefit_id' => 'int',
		'referance_package_id' => 'int',
		'value' => 'int',
		'expire_time' => 'datetime'
	];

	public function benefit()
	{
		return $this->belongsTo(Benefit::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function packages_price()
	{
		return $this->belongsTo(PackagesPrice::class, 'referance_package_id');
	}
}
