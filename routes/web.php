<?php

use App\Http\Controllers\CadastroUsuarioController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuizCardapioController;
use App\Http\Controllers\RefeitorioController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('home.welcome');
Route::get('/contato', [ContatoController::class, 'index'])->name('contato');
Route::get('/falar-com-a-cozinha', [ContatoController::class, 'conversar'])->name('contato.cozinha');
Route::get('/refeitorio', [RefeitorioController::class, 'index'])->name('refeitorio');
Route::get('/cardapios', [CardapioController::class, 'index'])->name('cardapios.index');
Route::get('/troca-almoco', [RefeitorioController::class, 'trocaAlmoco'])->name('troca_almoco');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/cadastro', [CadastroUsuarioController::class, 'index'])->name('cadastro');
Route::get('/cadastro_usuario', [CadastroUsuarioController::class, 'index'])->name('cadastro_usuario');
Route::get('/Cadastro_usuario', fn () => redirect()->route('cadastro_usuario'))->name('register');
Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario');
Route::get('/fale_com_a_lia', [LiaController::class, 'index'])->name('fale_com_a_lia');
Route::get('/sobre', [SobreController::class, 'index'])->name('sobre');
Route::get('/quiz', [QuizCardapioController::class, 'index'])->name('quiz');
Route::get('/solicitacao-de-troca', [SolicitacaoController::class, 'index'])->name('solicitacao_de_troca');
Route::get('/solicitacao-de-troca/confirmacao', [SolicitacaoController::class, 'confirmacao'])->name('solicitacao_de_troca.confirmacao');
Route::get('Login', [LoginController::class, 'Login'])->name('login_funcionario');
