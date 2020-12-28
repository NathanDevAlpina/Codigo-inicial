<?php

namespace Source\Controllers;

use Source\Business\SampleBusiness;
use Source\Controllers\Controller;
use Source\DAOs\SampleDAO;
use Source\Models\{
    Model,
    SampleModel
};

class SampleController extends Controller
{
    public function __construct()
    {
        $this->dao = new SampleDAO();
        $this->business = new SampleBusiness($this->dao);
    }
    
    /* override */
    protected function fillModel(array $data): Model
    {
        $id = isset($data["id"]) ? (int)$data["id"] : 0;
        $description = trim((string)$data["description"]);
        
        $model = (new SampleModel())
            ->setId($id)
            ->setDescription($description);
        
        return $model;
    }
}