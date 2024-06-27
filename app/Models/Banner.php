<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $fillable = [
        'image',
        'text',
        'video',
        'position',
        'z_index',
        'type',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at', 'creator_type', 'creator_id', 'editor_type'];
    public $translatable = ['image', 'text'];

    public function getImageAttribute($value): null|string
    {
        return ($value == null) ? null : 'uploaded/banner/' . $value;
    }

    public function getVideoAttribute($value): null|string
    {
        return ($value == null) ? null : 'uploaded/banner/' . $value;
    }
}
