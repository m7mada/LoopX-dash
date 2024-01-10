<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Benefit;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PackagesBenefit
 * 
 * @property int $id
 * @property int $package_id
 * @property int $benefit_id
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Benefit $benefit
 * @property Package $package
 *
 * @package App\Models\Base
 */
class PackagesBenefit extends Model
{
	protected $table = 'packages_benefits';

	protected $casts = [
		'package_id' => 'int',
		'benefit_id' => 'int'
	];

	public function benefit()
	{
		return $this->belongsTo(Benefit::class);
	}

	public function package()
	{
		return $this->belongsTo(Package::class);
	}
}
