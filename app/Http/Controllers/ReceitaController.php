<?php

namespace App\Http\Controllers;

use App\Services\Receita\ReceitaService;
use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function __construct(
        private ReceitaService $receitaService
    ) {
        
    }

    public function index()
    {
        return $this->receitaService->list();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        return $this->receitaService->create($request);
    }

    public function get(int $id)
    {
        return $this->receitaService->getById($id);
    }

    public function update(int $id, Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'valor' => 'required',
            'data' => 'required'
        ]);

        return $this->receitaService->update($id, $request);
    }

    public function destroy(int $id)
    {
        return $this->receitaService->destroy($id);
    }
}
