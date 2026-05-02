<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loans';

    protected $fillable = [
        'user_id',    
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'loan_date'   => 'datetime',
        'due_date'    => 'datetime',
        'return_date' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function fineLogs()
    {
        return $this->hasMany(FineLog::class, 'loan_id', 'id');
    }
}