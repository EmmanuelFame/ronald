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
        return $this->belongsTo(User::class);
    }
}
