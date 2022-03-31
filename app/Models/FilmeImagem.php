<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmeImagem extends Model
{
    use HasFactory;

    protected $table = 'filme_imagens';

        /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['imagem_url', 'filme_id'];
}
