<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackagesPricesDiscount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PackagesPrice
 * 
 * @property int $id
 * @property int $price
 * @property int $currency_id
 * @property int $country_id
 * @property int $package_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Country $country
 * @property Currency $currency
 * @property Package $package
 * @property Collection|Order[] $orders
 * @property Collection|PackagesPricesDiscount[] $packages_prices_discounts
 *
 * @package App\Models\Base
 */
class PackagesPrice extends Model
{
	use SoftDeletes;
	protected $table = 'packages_prices';

	protected $casts = [
		'price' => 'int',
		'currency_id' => 'int',
		'country_id' => 'int',
		'package_id' => 'int'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}

	public function currency()
	{
		return $this->belongsTo(Currency::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}

	public function orders()
	{
		return $this->belongsToMany(Order::class, 'order_packages_prices', 'package_price_id')
					->withPivot('id', 'expire_time')
					->withTimestamps();
	}

	public function packages_prices_discounts()
	{
		return $this->hasMany(PackagesPricesDiscount::class, 'price_id');
	}
}
