<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Twin; 



class Messages extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'twins_messages';

    protected $fillable = [
        "twin_id",
    ];

    public function originTwin(): BelongsTo
    {
        return $this->belongsTo(Twin::class,'twin_external_id','twin_id');
    }



}
