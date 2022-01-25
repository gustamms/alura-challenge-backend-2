<?php

namespace App\Http\Controllers;

use App\Models\Receitas;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        $response = Receitas::where('descricao', $request->descricao)->get()->toArray();

        if(empty($response)){
            return Receitas::create($request->all());
        } else {
            foreach($response as $res) {
                $dataNoBanco = $res['data'];
                $dataNoBanco = date('m', strtotime($dataNoBanco));
                $dataDaRequisicao = $request->data;
                $dataDaRequisicao = date('m', strtotime($dataDaRequisicao));

                if($dataDaRequisicao === $dataNoBanco) {
                    return 'Já existe uma receita no mesmo mês';
                }
            }
        }
        
        return Receitas::create($request->all());
    }
}
