<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;

class UserFineBalance extends Model
{
    protected $table = 'user_fine_balances';
    
    protected $primaryKey = 'id'; 
    public $incrementing = true;

    protected $fillable = [
        'user_id', 
        'total_fine', 
        'total_overdue_seconds', 
        'total_overdue_books'
    ];

    public static function getTotalGlobalFine()
    {
        $permanentFine = self::sum('total_fine');
        $now = Carbon::now('Asia/Jakarta');
        $overdueLoans = Loan::where('status', 'borrowed')
            ->where('due_date', '<', $now->toDateTimeString())
            ->get();

        $runningFine = 0;
        foreach ($overdueLoans as $loan) {
            $due = Carbon::parse($loan->due_date);
            $diffInSeconds = $due->diffInSeconds($now);
            $days = ceil($diffInSeconds / 86400);

            $fineAmount = 0;
            if ($days >= 1) $fineAmount += 10000;
            if ($days > 1) $fineAmount += ($days - 1) * 5000;

            $runningFine += $fineAmount;
        }

        return $permanentFine + $runningFine;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}