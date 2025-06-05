<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'phone', 'operator_name', 'amount', 'receipt_path', 'status'
    ];
    public function user()
    {
        //my user relationship
        return $this->belongsTo(User::class);
    }
}
