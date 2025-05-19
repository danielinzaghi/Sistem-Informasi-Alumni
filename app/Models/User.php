<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'users_id', 'id');
    }
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'users_id', 'id');
    }


    public function alumni()
    {
        return $this->hasOneThrough(
            Alumni::class,
            Mahasiswa::class,
            'users_id',     // foreign key di Mahasiswa
            'mahasiswa_id', // foreign key di Alumni
            'id',           // local key di User
            'id'            // local key di Mahasiswa
        );
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
