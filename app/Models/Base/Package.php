<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Benefit;
use App\Models\PackagesPrice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Package
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $class_name
 * @property float $price
 * @property int|null $discount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $messages
 * @property string $type
 * 
 * @property Collection|Benefit[] $benefits
 * @property Collection|PackagesPrice[] $packages_prices
 *
 * @package App\Models\Base
 */
class Package extends Model
{
	protected $table = 'packages';

	protected $casts = [
		'price' => 'float',
		'discount' => 'int',
		'messages' => 'int'
	];

	public function benefits()
	{
		return $this->belongsToMany(Benefit::class, 'packages_benefits','package_id','benefit_id')
					->withPivot('id', 'value')
					->withTimestamps();
	}

	public function packages_prices()
	{
		return $this->hasMany(PackagesPrice::class,'package_id','id');
	}
}
