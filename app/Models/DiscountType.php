<?php

namespace App\Models;

use App\Models\Base\DiscountType as BaseDiscountType;

class DiscountType extends BaseDiscountType
{
	protected $fillable = [
		'name',
		'factor'
	];
}
