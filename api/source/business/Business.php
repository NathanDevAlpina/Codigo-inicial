<?php

namespace Source\Business;

use Source\DAOs\DAO;
use Source\Models\Model;

abstract class Business
{
    protected $dao;

    public function __construct(DAO $dao)
    {
        $this->dao = $dao;
    }

    abstract public function checkCreate(Model $model): array;
    abstract public function checkUpdate(Model $model): array;

    public function checkDelete(int $id): array
    {
        $errors = [];

        $model = $this->dao->findFirstBy("id", $id);

        if (empty($model)) {
            $errors[] = "Dados não encontrados para excluir";
        }

        return $errors;
    }
    
    protected function getErrorsId(int $id, string $entityName): array
    {
        $errors = [];
        
        $modelById = $this->dao->findFirstBy("id", $id);
        
        if (empty($modelById)) {
            $errors[] = "{$entityName} não encontrado(a)";
        }
        
        return $errors;
    }
}