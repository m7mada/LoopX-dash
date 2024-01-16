<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\PackagesPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * 
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $is_default
 * 
 * @property Collection|PackagesPrice[] $packages_prices
 *
 * @package App\Models\Base
 */
class Country extends Model
{
	protected $table = 'countries';

	protected $casts = [
		'is_default' => 'int'
	];

	public function packages_prices()
	{
		return $this->hasMany(PackagesPrice::class);
	}
}
