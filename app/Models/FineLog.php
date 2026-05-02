<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FineLog extends Model
{
    protected $table = 'fine_logs';
    protected $fillable = ['user_id', 'loan_id', 'book_title', 'final_fine_amount', 'calculated_at'];
}