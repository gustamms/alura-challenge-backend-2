<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    public function __construct(private Despesas $despesas)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        return $this->despesas->create($request->all());
    }
}
