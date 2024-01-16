<?php

namespace App\Models;

use App\Models\Base\OrderLine as BaseOrderLine;

class OrderLine extends BaseOrderLine
{
	protected $fillable = [
		'order_id',
		'benefit_id',
		'referance_package_id',
		'value',
		'expire_time'
	];
}
