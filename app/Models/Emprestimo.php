<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = ['livro_id', 'user_id', 'data_emprestimo', 'data_devolucao_prevista', 'status'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function livro()
    {
        return $this->belongsTo(\App\Models\Livro::class, 'livro_id');
    }

    public function multa()
    {
        return $this->hasOne(\App\Models\Multa::class, 'emprestimo_id');
    }
}
