<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Benefit
 * 
 * @property int $id
 * @property string $name
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Package[] $packages
 *
 * @package App\Models\Base
 */
class Benefit extends Model
{
	protected $table = 'benefits';

	public function packages()
	{
		return $this->belongsToMany(Package::class, 'packages_benefits')
					->withPivot('id', 'value')
					->withTimestamps();
	}
}
