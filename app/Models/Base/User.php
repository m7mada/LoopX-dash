<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Order;
use App\Models\Twin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $image
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $is_admin
 * 
 * @property Collection|Order[] $orders
 * @property Collection|Twin[] $twins
 *
 * @package App\Models\Base
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_admin' => 'int'
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function twins()
	{
		return $this->hasMany(Twin::class);
	}
}
