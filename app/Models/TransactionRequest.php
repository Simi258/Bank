<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRequest extends Model
{
    use HasFactory;

    protected $table = 'transaction_request';

    protected $fillable = ['sender_name', 'receiver_name', 'reason', 'amount', 'transaction_process'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
