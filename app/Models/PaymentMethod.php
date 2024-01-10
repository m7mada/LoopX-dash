<?php

namespace App\Models;

use App\Models\Base\PaymentMethod as BasePaymentMethod;

class PaymentMethod extends BasePaymentMethod
{
	protected $fillable = [
		'name'
	];
}
