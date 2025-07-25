<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'autor', 'categoria', 'ano_publicacao', 'descricao', 'isbn', 'quantidade'];

    // Relacionamento com empréstimos
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    // Método para obter livros mais populares no mês atual
    public static function getLivrosMaisPopulares($limit = 10)
    {
        return self::select('livros.*', DB::raw('COUNT(emprestimos.id) as total_emprestimos'))
            ->leftJoin('emprestimos', 'livros.id', '=', 'emprestimos.livro_id')
            ->whereMonth('emprestimos.created_at', now()->month)
            ->whereYear('emprestimos.created_at', now()->year)
            ->groupBy('livros.id')
            ->orderBy('total_emprestimos', 'desc')
            ->limit($limit)
            ->get();
    }

    // Método para obter estatísticas por categoria
    public static function getEstatisticasPorCategoria()
    {
        return self::select('categoria', DB::raw('COUNT(livros.id) as total_livros'), DB::raw('COUNT(emprestimos.id) as total_emprestimos'))
            ->leftJoin('emprestimos', 'livros.id', '=', 'emprestimos.livro_id')
            ->whereMonth('emprestimos.created_at', now()->month)
            ->whereYear('emprestimos.created_at', now()->year)
            ->groupBy('categoria')
            ->orderBy('total_emprestimos', 'desc')
            ->get();
    }

    // Método para obter dados do gráfico mensal
    public static function getDadosGraficoMensal()
    {
        return self::select(DB::raw('MONTH(emprestimos.created_at) as mes'), DB::raw('COUNT(*) as total'))
            ->join('emprestimos', 'livros.id', '=', 'emprestimos.livro_id')
            ->whereYear('emprestimos.created_at', now()->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();
    }
}
