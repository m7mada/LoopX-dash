<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\DiscountType;
use App\Models\PackagesPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PackagesPricesDiscount
 * 
 * @property int $id
 * @property string $name
 * @property int $price_id
 * @property int|null $is_active
 * @property Carbon|null $start
 * @property Carbon|null $end
 * @property int $discount
 * @property int $type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property PackagesPrice $packages_price
 * @property DiscountType $discount_type
 *
 * @package App\Models\Base
 */
class PackagesPricesDiscount extends Model
{
	use SoftDeletes;
	protected $table = 'packages_prices_discounts';

	protected $casts = [
		'price_id' => 'int',
		'is_active' => 'int',
		'start' => 'datetime',
		'end' => 'datetime',
		'discount' => 'int',
		'type_id' => 'int'
	];

	public function packages_price()
	{
		return $this->belongsTo(PackagesPrice::class, 'price_id');
	}

	public function discount_type()
	{
		return $this->belongsTo(DiscountType::class, 'type_id');
	}
}
