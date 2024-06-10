<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $with = ['name','email'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
        $query->where(fn($query) =>
        $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
        )
        );

        $query->when($filters['name'] ?? false, fn($query, $name) =>
        $query->whereHas('name', fn ($query) =>
        $query->where('username', $name)
        )
        );

        $query->when($filters['email'] ?? false, fn($query, $author) =>
        $query->whereHas('email', fn ($query) =>
        $query->where('email', $author)
        )
        );
    }


    public function name()
    {
        return $this->belongsTo(User::class);
    }

    public function email()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name', 'email', 'username', 'iban', 'user_type', 'password',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'users_id');
    }

    public function isAdmin()
    {
        return $this->employer; // this looks for an admin column in your users table
    }

}

