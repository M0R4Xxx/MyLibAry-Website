<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Book extends Model
{
    protected $fillable = [
        'api_id',
        'title',
        'author_name',
        'category_name', 
        'summary',
        'total_pages',   
        'published_date',
        'tags',
        'publisher',
        'cover_image'
    ];

    public function getPublishedDateAttribute($value)
    {
        if (!$value) return null;
        
        try {
            return Carbon::parse($value)->translatedFormat('d F Y');
        } catch (\Exception $e) {
            return $value; 
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id')->latest();
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function wishlistedBy()
    {

        return $this->belongsToMany(User::class, 'wishlists', 'book_id', 'user_id')
                    ->withTimestamps();
    }

    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_id');
    }
}