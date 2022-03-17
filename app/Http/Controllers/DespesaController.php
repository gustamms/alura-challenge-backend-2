<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use App\Services\Despesa\DespesaService;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    public function __construct(
        private Despesas $despesas,
        private DespesaService $despesaService
    ) {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        return $this->despesaService->create($request->all());
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

        return $this->despesaService->update($id, $request->all());
    }
}
