<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ContactUs extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable=[
        'email','message','name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }


}
