<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;



class TempRecivedMessages extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'temp_recived_messages';

    protected $fillable = ["res"];



}
