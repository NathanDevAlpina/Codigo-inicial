<?php

namespace Source\Models;

use Source\Models\Model;

class SampleModel extends Model
{
    /**
     * @var type string
     */
    private $description;
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function setDescription(string $description): Model
    {
        $this->description = $description;
        
        return $this;
    }
}