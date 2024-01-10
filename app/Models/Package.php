<?php

namespace App\Models;

use App\Models\Base\Package as BasePackage;

class Package extends BasePackage
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
}
