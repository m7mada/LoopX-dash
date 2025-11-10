<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['path','name','extension','size','twin_id'] ;

    protected $appends = ['short_path'];

    public function getPathAttribute($value): ?string
    {
        if ($value)
            return \Storage::disk('s3')->url($value);
        else return null;
    }

    public function getSizeAttribute($value): ?string
    {
        if ($value >= 1000000)
            return round($value / 1000000, 2) . ' MB';
        else
            return round($value / 1000, 2) . ' KB';
    }

    public function getShortPathAttribute(): ?string
    {
        if ($this->path) {
            return $this->getAttributes()['path'];
        }
        return null;
    }


}
