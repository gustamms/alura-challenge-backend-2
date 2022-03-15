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

    public function index()
    {
        return $this->despesas->all();
    }

    public function get(int $id)
    {
        return $this->despesas->where('id', $id)->get();
    }

    public function update(int $id, Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        $response = $this->despesas->where('id', $id)->update($request->all());

        return $response ? 'Atualizado com sucesso' : 'Não foi possível atualizar';
    }

    public function destroy(int $id)
    {
        $response = $this->despesas->where('id', $id)->delete();

        return $response ? "Id ${id} removido com sucesso" : "Não foi possível remover id ${id}";
    }
}
