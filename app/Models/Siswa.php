<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_profile', 
    ];

    protected $hidden = [
        'password',
    ];

    public function wishlists()
    {
    return $this->belongsToMany(Book::class, 'wishlists', 'siswa_id', 'book_id')
        ->withTimestamps(); 
    }


    public function loans()
    {
        return $this->hasMany(Loan::class, 'siswa_id', 'id_siswa');
    }
}