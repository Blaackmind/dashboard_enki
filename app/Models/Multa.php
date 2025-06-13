<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    use HasFactory;

    protected $fillable = [
        'emprestimo_id',
        'valor',
        'paga',
        'data_pagamento'
    ];

    protected $casts = [
        'paga' => 'boolean',
        'data_pagamento' => 'datetime',
        'valor' => 'decimal:2'
    ];

    public function emprestimo()
    {
        return $this->belongsTo(Emprestimo::class);
    }
} 