<?php

namespace App\Models;

use App\Models\Base\PackagesPricesDiscount as BasePackagesPricesDiscount;

class PackagesPricesDiscount extends BasePackagesPricesDiscount
{
	protected $fillable = [
		'name',
		'price_id',
		'is_active',
		'start',
		'end',
		'discount',
		'type_id'
	];
}
