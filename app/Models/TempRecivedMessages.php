<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;



class TempRecivedMessages extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'temp_recived_messages';

    //protected $fillable = ["role", "content", "twin_id", "botpress_user_id", "botpress_bot_id", "botpress_conversation_id", "botpress_messageId", "botpress_integration", "botpress_channel", "botpress_eventId", "botpress_eventType", "botpress_createdOn", "created_at", "event_payload","botpress_user_out_id"];



}
