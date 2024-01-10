<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Twin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $path
 * @property string|null $type
 * @property string|null $size
 * @property string|null $extension
 * @property int $twin_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Twin $twin
 *
 * @package App\Models\Base
 */
class File extends Model
{
	protected $table = 'files';

	protected $casts = [
		'twin_id' => 'int'
	];

	public function twin()
	{
		return $this->belongsTo(Twin::class);
	}
}
