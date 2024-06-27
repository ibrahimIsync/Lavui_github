<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ProductBrand extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $fillable = ['name', 'slug', 'image', 'description', 'status'];
    protected $hidden = ['created_at', 'updated_at', 'creator_type', 'creator_id', 'editor_type'];
    public $translatable = ['name', 'description'];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class)->where(['status' => Status::ACTIVE]);
    }

    public function getImageAttribute($value): string
    {
        return 'uploaded/brand/' . $value;
    }
}
