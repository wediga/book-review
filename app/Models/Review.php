<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating'];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    protected static function booted(): void
    {
        static::updated(fn(Review $review) => cache()->forget('book:' . $review->book_id));
        static::deleted(fn(Review $review) => cache()->forget('book:' . $review->book_id));
        static::created(fn(Review $review) => cache()->forget('book:' . $review->book_id));
    }
}
