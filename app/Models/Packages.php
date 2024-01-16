<?php

namespace App\Models;

use App\Models\Base\Package as BasePackage;

class Packages extends BasePackage
{
	protected $fillable = [
		'title',
		'description',
		'class_name',
		'price',
		'discount',
		'messages',
		'type'
	];

	public function getPrice()
	{
		return $this->hasOne(PackagesPrice::class,'package_id','id');
	}
}
