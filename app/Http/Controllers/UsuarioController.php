<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        return view('cadastro_usuario');
    }

    // Cadastrar usuário
    public function salvar_usuario(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|max:14',
            'data_nascimento' => 'required|date'
        ]);

        try {
            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->save();

            return response()->json([
                'message' => 'Usuário cadastrado com sucesso',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao cadastrar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    // Buscar usuário por ID
    public function ver_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $usuario = Usuario::find($request->id);

        if ($usuario) {
            return response()->json([
                'usuario' => $usuario,
                'erro' => 'n'
            ], 200);
        }

        return response()->json([
            'message' => 'Usuário não encontrado',
            'erro' => 's'
        ], 404);
    }

    // Listar todos os usuários
    public function listar_usuarios(Request $request)
    {
        $usuarios = Usuario::all();

        return response()->json([
            'usuarios' => $usuarios,
            'erro' => 'n'
        ], 200);
    }

    // Listar somente nome e email
    public function listar_usuarios_simples(Request $request)
    {
        $usuarios = Usuario::select('nome', 'email')->get();

        return response()->json([
            'usuarios' => $usuarios,
            'erro' => 'n'
        ], 200);
    }

    // Alterar usuário
    public function alterar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id',
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'senha' => 'required|string|min:8',
            'cpf' => 'required|string|max:14',
            'data_nascimento' => 'required|date'
        ]);

        try {
            $usuario = Usuario::findOrFail($request->id);

            if ($usuario->cpf != $request->cpf) {
                $usuario_cpf_igual = Usuario::where(
                    'cpf',
                    $request->cpf
                )->first();

                if ($usuario_cpf_igual) {
                    return response()->json([
                        'message' => 'CPF já cadastrado',
                        'erro' => 's'
                    ], 200);
                }
            }

            if ($usuario->email != $request->email) {
                $usuario_email_igual = Usuario::where(
                    'email',
                    $request->email
                )->first();

                if ($usuario_email_igual) {
                    return response()->json([
                        'message' => 'Email já cadastrado',
                        'erro' => 's'
                    ], 200);
                }
            }

            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = Hash::make($request->senha);
            $usuario->cpf = $request->cpf;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->save();

            return response()->json([
                'message' => 'Usuário alterado com sucesso',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao alterar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    // Deletar usuário
    public function deletar_usuario(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:usuario,id'
        ]);

        try {
            $usuario = Usuario::findOrFail($request->id);
            $usuario->delete();

            return response()->json([
                'message' => 'Usuário deletado com sucesso',
                'erro' => 'n'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao deletar usuário',
                'erro' => 's',
                'msg_erro' => $th->getMessage()
            ], 500);
        }
    }

    // Login do usuário
    public function login(Request $request){
            $request->validate([
                'email' => 'required|',
                'senha' => 'required|',
            ]);


            $usuario = Usuario::where('email','=', $request->email)->first();
            if($usuario){
                if(Hash::check($request->senha, $usuario->senha)){
                    $usuariotoken = new Usuariotoken();
                    $usuariotoken->usuario_id = $usuario->id;
                    $usuariotoken->token = Hash::make($usuario->id . $usuario->email . now());
                    $usuariotoken->valido_ate = now()->addDays(7);
                    $usuariotoken->save();
                    return response()->json(['message' => 'Login realizado com sucesso' , 'erro' => 'n', 'token' => $usuariotoken->token],200 );

                }else{
                return response()->json(['message' => 'Usuario ou senha não encontrado', 'erro' => 's'],200);
            }

            }else{
                return response()->json(['message' => 'Email não encontrado', 'erro' => 's'],200);
            }
        }
        public function logout(Request $request){
            $request->validate([
                'usuario_id' => 'required|integer|exists:usuarios,id',
                'token' => 'required|string',
            ]);
    $token = Usuariotoken::where('usuario_id', $request->usuario_id)
        ->where('token', $request->token)
        ->first();

    if ($token) {$token->delete();

        return response()->json(['message' => 'Logout realizado com sucesso','erro' => 'n'], 200);

    }return response()->json(['message' => 'Token não encontrado','erro' => 's'], 200);
}
}
