<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acesso extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip',
        'data_acesso'
    ];

    protected $casts = [
        'data_acesso' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
