<?php

namespace App\Models;

use App\Models\Base\PackagesPrice as BasePackagesPrice;

class PackagesPrice extends BasePackagesPrice
{
	protected $fillable = [
		'price',
		'currency_id',
		'country_id',
		'package_id'
	];
}
