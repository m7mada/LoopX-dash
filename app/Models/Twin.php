<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\File;
use App\Models\Messages;
use App\Models\User;


class Twin extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'user_id', 'is_active','agent_persona','agent_instructions','example_messagesa','kb_model_name','msgs_model_name','agent_dialect','user_dialect','is_active','twin_external_id','creativity_temperature','botbress_bot_id','integrations_settings','custom_settings','handover_settings','botbress_bot_id','botbress_integration_key','botbress_workspace_id','botpress_webhook_link','botpress_access_token','fb_page_id','fb_page_access_token'
    ];
    public $timestamps = true;

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function messages(): HasMany 
    {
        $instance = $this->newRelatedInstance(Messages::class);

        return $this->hasManyMongo(Messages::class,"twin_id","twin_external_id");
    }

    public function hasManyMongo($related, $foreignKey = null, $localKey = null)
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return $this->newHasMany(
            $instance->newQuery(), $this, $foreignKey, $localKey
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
