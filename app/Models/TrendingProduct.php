<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrendingProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'gif', 'status', 'creator_type', 'creator_id', 'editor_type', 'editor_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getGifAttribute($value): string
    {
        return 'uploaded/trending/'.$value;
    }
}