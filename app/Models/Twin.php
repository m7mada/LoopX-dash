<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Twin extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'user_id', 'is_active','agent_persona','agent_instructions','example_messagesa','kb_model_name','msgs_model_name','agent_dialect','user_dialect'
    ];
    public $timestamps = true;
}
