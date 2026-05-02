<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id'];

    /**
     * Relasi ke User (Bisa Admin atau Siswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Relasi ke Buku
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}