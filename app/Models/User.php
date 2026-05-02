<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'all_library_users';


    protected $primaryKey = 'user_id'; 

    protected $fillable = [
        'username',
        'email',
        'password',
        'foto_profile',
        'role',
    ];

    protected $hidden = [
        'password',
    ];


    public function wishlists()
    {

        return $this->belongsToMany(Book::class, 'wishlists', 'user_id', 'book_id')
                    ->withTimestamps(); 
    }


    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_id', 'user_id');
    }

 
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->foto_profile) {
            return asset('storage/' . $this->foto_profile);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->username) . '&color=7F9CF5&background=EBF4FF';
    }
}