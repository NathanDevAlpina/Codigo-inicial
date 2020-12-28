<?php

namespace Source\DAOs;

use Source\DAOs\{
    ConnectionDB,
    DAO
};
use Source\Models\Model;

class SampleDAO extends DAO
{
    public function __construct()
    {
        parent::__construct("tbSamples");
    }
    
    /* override */
    public function create(Model $model): void
    {
        $sql = "INSERT INTO {$this->table} (description) VALUES (:description);";
        
        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute([
            "description" => $model->getDescription()
        ]);
        
        $model->setId($this->getInsertedId());
    }

    /* override */
    public function update(Model $model): void
    {
        $sql = "UPDATE {$this->table} SET description = :description WHERE id = :id;";
        
        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute([
            "description" => $model->getDescription(),
            "id" => $model->getId()
        ]);
    }
}