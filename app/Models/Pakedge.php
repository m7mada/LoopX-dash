<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakedge extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'description',
        'class_name',
        'price',
        'discount'
    ];
}
