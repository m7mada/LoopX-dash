<?php

namespace App\Models;

use App\Models\Base\Country as BaseCountry;

class Country extends BaseCountry
{
	protected $fillable = [
		'name',
		'code'
	];

	// protected static function booted()
    // {
    //     static::addGlobalScope('default', function (Builder $builder) {
    //         $builder->where('is_default', 1);
    //     });
    // }

}
