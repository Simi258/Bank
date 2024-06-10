<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = ['transaction_description', 'to_iban', 'from_iban', 'transaction_type', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function receiver()
    {
        return $this->hasOne(Account::class, 'to_iban', 'iban')->user;
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
