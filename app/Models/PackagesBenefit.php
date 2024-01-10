<?php

namespace App\Models;

use App\Models\Base\PackagesBenefit as BasePackagesBenefit;

class PackagesBenefit extends BasePackagesBenefit
{
	protected $fillable = [
		'package_id',
		'benefit_id',
		'value'
	];
}
