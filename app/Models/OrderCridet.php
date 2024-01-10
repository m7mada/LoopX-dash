<?php

namespace App\Models;

use App\Models\Base\OrderCridet as BaseOrderCridet;

class OrderCridet extends BaseOrderCridet
{
	protected $fillable = [
		'order_id',
		'cridet'
	];
}
