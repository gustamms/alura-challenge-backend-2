<?php

namespace App\Services\Despesa;

use App\Models\Despesas;

class DespesaService
{
    public function __construct(private Despesas $despesas)
    {
    }

    public function create(array $request)
    {
        if($this->haveCreatedInSameMonth($request['descricao'], $request['data'])) {
            return 'Já existe uma despesa cadastrada dentro do mês';
        }

        return $this->despesas->create($request);
    }

    public function update(int $despesaId, array $request)
    {
        if($this->despesas->where('id', $despesaId)->count() <= 0) {
            return 'Não existe despesa cadastrada com esse id';
        }

        if($this->haveCreatedInSameMonth($request['descricao'], $request['data'])) {
            return 'Já existe uma despesa cadastrada dentro do mês';
        }

        $responseUpdate = $this->despesas->where('id', $despesaId)->update($request);

        return $responseUpdate ? 'Atualizado com sucesso' : 'Não foi possível atualizar';
    }

    public function haveCreatedInSameMonth(string $descricaoRequest, string $dataRequest)
    {
        $response = $this->despesas->where('descricao', $descricaoRequest)->get();

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
