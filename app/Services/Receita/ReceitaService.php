<?php

namespace App\Services\Receita;

use App\Repositories\ReceitaRepository;
use Illuminate\Http\Request;

class ReceitaService 
{
    public function __construct(
        private ReceitaRepository $receitaRepository
    ) {
        
    }

    public function create(Request $request) 
    {
        if($this->haveCreatedInSameMonth($request->descricao, $request->data)) {
            return 'Já existe uma receita no mesmo mês';
        }

        return $this->receitaRepository->insert($request->all());
    }

    public function list()
    {
        return $this->receitaRepository->all()->toArray();
    }

    public function getById(int $id)
    {
        return $this->receitaRepository->getByQuery('id', $id)->toArray();
    }

    public function update(int $id, Request $request)
    {
        $response = $this->receitaRepository->getByQuery("id", $id);
        if(empty($response->toArray())) {
            return 'Não existe receita com esse id';
        }

        if($this->haveCreatedInSameMonth($request->descricao, $request->data)) {
            return 'Já existe uma receita no mesmo mês';
        }

        return $this->receitaRepository->update($id, $request->all());
    }

    public function destroy(int $id)
    {
        $response = $this->receitaRepository->getByQuery("id", $id);
        if(empty($response->toArray())) {
            return 'Não existe receita com esse id';
        }

        return $this->receitaRepository->delete($id);
    }

    public function haveCreatedInSameMonth(string $descricaoRequest, string $dataRequest)
    {
        $response = $this->receitaRepository->getByQuery('descricao', $descricaoRequest)->toArray();

        if(!empty($response)){
            foreach($response as $res) {
                $dataNoBanco = $res['data'];
                $dataNoBanco = date('m', strtotime($dataNoBanco));
                $dataDaRequisicao = $dataRequest;
                $dataDaRequisicao = date('m', strtotime($dataDaRequisicao));

                if($dataDaRequisicao === $dataNoBanco) {
                    return true;
                }
            }
        }

        return false;
    }
}