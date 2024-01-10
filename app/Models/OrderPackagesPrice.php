<?php

namespace App\Models;

use App\Models\Base\OrderPackagesPrice as BaseOrderPackagesPrice;

class OrderPackagesPrice extends BaseOrderPackagesPrice
{
	protected $fillable = [
		'package_price_id',
		'expire_time'
	];
}
