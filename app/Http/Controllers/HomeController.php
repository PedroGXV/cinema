<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Filme;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $filmes = new Filme;
        $filmes['lancamentos'] = $filmes->lancamentos();

        $cinemas = Cinema::all();

        return view('welcome', compact('filmes', 'cinemas'));
    }
}
