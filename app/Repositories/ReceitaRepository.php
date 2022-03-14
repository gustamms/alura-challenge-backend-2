<?php

namespace App\Repositories;

use App\Models\Receitas;
use Illuminate\Support\Facades\DB;
use Exception;

class ReceitaRepository 
{
    public function insert(array $data) 
    {
        try {
            DB::beginTransaction();

            Receitas::create($data);
            
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getByQuery(string $column, string $value)
    {
        try {
            DB::beginTransaction();

            $response = Receitas::where($column, $value)->get();
            
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function all()
    {
        try {
            DB::beginTransaction();

            $response = Receitas::all();
            
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function update(int $id, array $data)
    {
        try {
            DB::beginTransaction();

            $response = Receitas::where("id", $id)->update($data);
            
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function delete(int $id)
    {
        try {
            DB::beginTransaction();

            $response = Receitas::where("id", $id)->delete();
            
            DB::commit();
            return $response;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}