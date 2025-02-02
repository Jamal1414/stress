<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'media',
        'title',
        'content',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}