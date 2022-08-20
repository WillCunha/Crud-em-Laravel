<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    public function index()
    {
        return view ('index');
    }

    public function store(Request $request)
    {
        $file = $request->file('avatar');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $dados = [
            'primeiro_nome' => $request->pnomme,
            'ultimo_nome' => $request->unome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'post' => $request->post,
            'imagem' => $fileName
        ];

        Funcionario::create($dados);
        return response()->json([
            'status' => 200
        ]);
    }

    public function puxar()
    {
        $empregados = Funcionario::all();
        $saida = '';
        if($empregados->count() > 0){
            $saida .= '<table class="table table-striped table-sm text-center align-middle">
                            <thead>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Post</th>
                                <th>Ação</th>
                            </thead>
                            <tbody>';
                        foreach($empregados as $empregado){
                            $saida .= '<tr>
                                        <td>'.$empregado->id.'</td>
                                        <td><img src="storage/images/'.$empregado->imagem.'" alt='.$empregado->primeiro_nome.' '.$empregado->ultimo_nome.' width="50" class="img-thumbnail rounded-circle"></td>
                                        <td>'.$empregado->primeiro_nome.' '.$empregado->ultimo_nome.'</td>
                                        <td>'.$empregado->email.'</td>
                                        <td>'.$empregado->telefone.'</td>
                                        <td>'.$empregado->post.'</td>
                                        <td>
                                            <a href="#" id="'.$empregado->id.'" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editarEmpregado"><i class="bi-pencil-square h4"></i></a>
                                            <a href="#" id="'.$empregado->id.'" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                                        </td>
                                    </tr>';
                        }
                        $saida .= '</tbody>
                                </table>
                                ';
                        echo $saida;
        }else{
            echo '<h1 class="text-center text-secondary my-5">Não há registros!</h1>';
        }
    }

    public function editar(Request $request)
    {
        $id = $request->id;
        $empregado = Funcionario::find($id);
        return response()->json($empregado);
    }

    public function atualizar(Request $request)
    {
        $fileName = '';
        $empregado = Funcionario::find($request->emp_id);
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if($empregado->avatar){
                Storage::delete('public/images'.$empregado->imagem);
            }
        }else{
            $fileName = $request->emp_avatar;
        }
            $empData = [
                'primeiro_nome' => $request->pnome,
                'ultimo_nome' => $request->unome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'post' => $request->post,
                'imagem' => $fileName
            ];

        $empregado->update($empData);
        return response()->json([
            'status' => 200
        ]);

        }

        public function deletar(Request $request)
        {
            $id = $request->id;
            $empregado = Funcionario::find($id);
            Storage::delete('public/images/'.$empregado->imagem);
            Funcionario::destroy($id);

        }
    }

