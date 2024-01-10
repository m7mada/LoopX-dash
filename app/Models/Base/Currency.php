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
 * Class Currency
 * 
 * @property int $id
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|PackagesPrice[] $packages_prices
 *
 * @package App\Models\Base
 */
class Currency extends Model
{
	protected $table = 'currencies';

	public function packages_prices()
	{
		return $this->hasMany(PackagesPrice::class);
	}
}
