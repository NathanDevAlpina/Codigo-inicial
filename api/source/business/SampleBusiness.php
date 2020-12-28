<?php

namespace Source\Business;

use Source\Business\Business;
use Source\DAOs\SampleDAO;
use Source\Models\Model;

class SampleBusiness extends Business
{
    public function __construct(SampleDAO $dao)
    {
        parent::__construct($dao);
    }
    
    /* override */
    public function checkCreate(Model $model): array
    {
        $errors = [];

        $id = $model->getId();
        $description = $model->getDescription();
        
        $errors = array_merge($errors, $this->getErrorsDescription($description, $id));
        
        return $errors;
    }
    
    /* override */
    public function checkUpdate(Model $model): array
    {
        $errors = [];

        $id = $model->getId();
        $description = $model->getDescription();
        
        $errors = array_merge($this->getErrorsId($id, "Amostra"));
        
        if (empty($errors)) {
            $errors = array_merge($errors, $this->getErrorsDescription($description, $id));
        }
        
        return $errors;
    }
    
    private function getErrorsDescription(string $description, int $id): array
    {
        $errors = [];
        
        if (empty($description)) {
            $errors[] = "Descrição obrigatória";
        } else {
            $testByDescription = $this->dao->findFirstBy("description", $description);

            if (!empty($testByDescription) && $testByDescription->id != $id) {
                $errors[] = "Descrição já existe";
            }
        }
        
        return $errors;
    }
}