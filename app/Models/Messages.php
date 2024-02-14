<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Twin; 
use App\Models\Conversations ;



class Messages extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'twins_messages';

    protected $fillable = ["role", "content", "twin_id", "botpress_user_id", "botpress_bot_id", "botpress_conversation_id", "botpress_messageId", "botpress_integration", "botpress_channel", "botpress_eventId", "botpress_eventType", "botpress_createdOn", "created_at", "event_payload"];


    public function originTwin(): BelongsTo
    {
        return $this->belongsTo(Twin::class,'twin_external_id','twin_id');
    }

    public function isPauseConversation(): BelongsTo
    {
        return $this->belongsTo(Conversations::class,'botpress_conversation_id','id');
    }


}
