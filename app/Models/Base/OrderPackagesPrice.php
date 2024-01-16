<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use App\Models\PackagesPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderPackagesPrice
 * 
 * @property int $id
 * @property int $package_price_id
 * @property int $order_id
 * @property Carbon $expire_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 * @property PackagesPrice $packages_price
 *
 * @package App\Models\Base
 */
class OrderPackagesPrice extends Model
{
	protected $table = 'order_packages_prices';

	protected $casts = [
		'package_price_id' => 'int',
		'order_id' => 'int',
		'expire_time' => 'datetime'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function packages_price()
	{
		return $this->belongsTo(PackagesPrice::class, 'package_price_id');
	}
}
