<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CadastroUsuarioController extends Controller
{
    public function index(): View
    {
        return view('cadastro_usuario');
    }
}