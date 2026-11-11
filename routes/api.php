<?php

use App\Http\Controllers\UsuarioController;
use App\Models\Cardapio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MensagemCozinhaController;
use App\Http\Controllers\QuizCardapioController;
use App\Http\Controllers\CardapioController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/salvar_usuario', [UsuarioController::class, 'salvar_usuario']);
Route::get('/ver_usuario', [UsuarioController::class, 'ver_usuario']);
Route::get('/listar_usuarios', [UsuarioController::class, 'listar_usuarios']);
Route::get('/listar_usuarios_simples', [UsuarioController::class, 'listar_usuarios_simples'])->name('usuario.listar_simples');
Route::put('/alterar_usuarios', [UsuarioController::class, 'alterar_usuario']);
Route::delete('/deletar_usuario', [UsuarioController::class, 'deletar_usuario']);

Route::post('salvar_funcionario', [FuncionarioController::class, 'salvar_funcionario']);
Route::get('ver_funcionario', [FuncionarioController::class,'ver_funcionario']);
Route::get('listar_funcionarios', [FuncionarioController::class, 'listar_funcionarios']);
Route::put('alterar_funcionario', [FuncionarioController::class,'alterar_funcionario']);
Route::delete('deletar_funcionario', [FuncionarioController::class,'deletar_funcionario']);


Route::post('salvar_mensagemCozinha', [MensagemCozinhaController::class, 'Salva_mensagemCozinha']);
Route::get('ver_mensagemCozinha', [MensagemCozinhaController::class, 'ver_mensagemCozinha']);
Route::delete('Deletear_mensagemCozinha', [MensagemCozinhaController::class, 'Deletear_mensagemCozinha']);
Route::put('alterar_mensagemCozinha', [MensagemCozinhaController::class, 'Alterar_mensagemCozinha']);


Route::post('/salvar_cardapio', [CardapioController::class, 'salvar_cardapio']);
Route::delete('/deletar_cardapio', [CardapioController::class, 'deletar_cardapio'])->name('cardapio.deletar');
Route::put('/alterar_cardapio', [CardapioController::class, 'alterar_cardapio'])->name('cardapio.alterar');
Route::get('/ver_cardapios', [CardapioController::class, 'ver_cardapios'])->name('cardapio.listar');
