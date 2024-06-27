<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CustomCollection extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $fillable = ['name', 'description', 'image', 'slug', 'status'];
    protected $hidden = ['created_at', 'updated_at', 'creator_type', 'creator_id', 'editor_type'];
    public $translatable = ['name', 'description'];

    public function getImageAttribute($value): string
    {
        return 'uploaded/custom-collection/' . $value;
    }
}
