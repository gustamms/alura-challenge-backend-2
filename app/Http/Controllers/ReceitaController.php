<?php

namespace App\Http\Controllers;

use App\Models\Receitas;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function store(Request $request)
    {
        // 1ª Validar
        // Validar os campos
        // Descricao - valor - data
        // Validator

        // 2ª Validar se a descricao da receita já foi utilizada dentro do mês
        
        return Receitas::create($request->all());
    }
}
