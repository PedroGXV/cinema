<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $table = 'filmes';

    protected $fillable = ['id'];

    public function lancamentos()
    {
        $currentDate = date_create(date("Y/m/d"));

        $futureDate = date_add($currentDate, date_interval_create_from_date_string('1 month'));
        $futureDateString = $futureDate->format('Y-m-d');

        // pegando um espaço de 2 messes para os lançamentos
        $targetDate = date_sub($currentDate, date_interval_create_from_date_string('2 months'));
        $dataString = $targetDate->format('Y-m-d');
        
        return $this->whereBetween('dataLancamento', [$dataString, $futureDateString])->limit(10)->get();
    }

    public function imagem()
    {
        return $this->hasMany(FilmeImagem::class);
    }
}
