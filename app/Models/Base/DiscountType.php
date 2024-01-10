<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PackagesPricesDiscount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DiscountType
 * 
 * @property int $id
 * @property string $name
 * @property string $factor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PackagesPricesDiscount[] $packages_prices_discounts
 *
 * @package App\Models\Base
 */
class DiscountType extends Model
{
	protected $table = 'discount_type';

	public function packages_prices_discounts()
	{
		return $this->hasMany(PackagesPricesDiscount::class, 'type_id');
	}
}
