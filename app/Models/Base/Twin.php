<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Twin
 * 
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $title
 * @property string|null $remember_token
 * @property int|null $is_active
 * @property string|null $agent_persona
 * @property string|null $agent_instructions
 * @property string|null $kb_model_name
 * @property string|null $msgs_model_name
 * @property string|null $agent_dialect
 * @property string|null $user_dialect
 * @property int $user_id
 * @property string $twin_external_id
 * @property string|null $example_messages
 * 
 * @property User $user
 * @property Collection|File[] $files
 *
 * @package App\Models\Base
 */
class Twin extends Model
{
	protected $table = 'twins';

	protected $casts = [
		'is_active' => 'int',
		'user_id' => 'int'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function files()
	{
		return $this->hasMany(File::class);
	}
}
