<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class Messages extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'twins_messages';
    //protected $fillable = ['title'];



}
