<?php

namespace App\Models;

use App\Models\Base\Benefit as BaseBenefit;

class Benefit extends BaseBenefit
{
	protected $fillable = [
		'name',
		'type'
	];
}
