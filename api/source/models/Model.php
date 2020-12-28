<?php

namespace Source\Models;

use DateTime;

abstract class Model
{
    /**
     * @var type int
     */
    protected $id;
    /**
     * @var type DateTime
     */
    protected $createdAt;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setId(int $id): Model
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(DateTime $createdAt): Model
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
}