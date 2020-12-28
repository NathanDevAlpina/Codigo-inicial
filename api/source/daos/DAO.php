<?php

namespace Source\DAOs;

use Source\DAOs\ConnectionDB;
use Source\Models\Model;

abstract class DAO
{
    protected $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }
    
    abstract public function create(Model $model): void;
    abstract public function update(Model $model): void;

    final public static function commitTransaction(): void
    {
        ConnectionDB::getInstance()->commit();
    }
  
    public function delete(int $id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id;";

        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute([
            "id" => $id
        ]);
    }
    
    public function findAll(): array
    {
        $sql = "SELECT * FROM {$this->table};";

        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findFirstBy(string $field, $value): ?object
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = :{$field} LIMIT 1;";

        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute([
            $field => $value
        ]);

        return $stmt->fetch() ?: null;
    }

    final protected function getInsertedId(): int
    {
        $sql = "SELECT LAST_INSERT_ID() AS id FROM {$this->table};";

        $stmt = ConnectionDB::getInstance()->prepare($sql);
        $stmt->execute();

        return $stmt->fetch()->id;
    }

    final public static function rollBackTransaction(): void
    {
        ConnectionDB::getInstance()->rollBack();
    }
  
    final public static function startTransaction(): void
    {
        ConnectionDB::getInstance()->beginTransaction();
    }
}