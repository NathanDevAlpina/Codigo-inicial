<?php

namespace Source\Controllers;

use Psr\Http\Message\{
    ResponseInterface as Response,
    ServerRequestInterface as Request
};
use Source\DAOs\DAO;
use Source\Models\Model;

abstract class Controller
{
    protected $business;
    protected $dao;
    
    abstract protected function fillModel(array $data): Model;
    
    public function create(Request $request, Response $response): void
    {
        $bodyRequest = $request->getParsedBody();
        
        $model = $this->fillModel($bodyRequest);

        $status = "fail";
        $dataResponse = $this->business->checkCreate($model);

        if (empty($dataResponse)) {
            DAO::startTransaction();

            try {
                $this->dao->create($model);

                DAO::commitTransaction();

                $status = "success";
                $dataResponse = [
                    "id" => $model->getId()
                ];
            } catch (Exception $exception) {
                DAO::rollBackTransaction();

                $dataResponse = [
                    "Erro inesperado"
                ];
            }
        }

        $response
            ->getBody()
            ->write(json_encode([
                "status" => $status,
                "data" => $dataResponse
            ]));
    }
    
    public function delete(Request $request, Response $response, int $id): void
    {
        $status = "fail";
        $dataResponse = $this->business->checkDelete($id);
        
        if (empty($dataResponse)) {
            DAO::startTransaction();

            try {
                $this->dao->delete($id);

                DAO::commitTransaction();

                $status = "success";
                $dataResponse = null;
            } catch (Exception $exception) {
                DAO::rollBackTransaction();

                $dataResponse = [
                    "Erro inesperado"
                ];
            }
        }
        
        $response
            ->getBody()
            ->write(json_encode([
                "status" => $status,
                "data" => $dataResponse
            ]));
    }
    
    public function findAll(Request $request, Response $response): void
    {
        $status = "success";
        $dataResponse = $this->dao->findAll();
        
        $response
            ->getBody()
            ->write(json_encode([
                "status" => $status,
                "data" => $dataResponse
            ]));
    }
    
    public function findFirstBy(Request $request, Response $response, string $field, $value): void
    {
        $status = "success";
        $dataResponse = $this->dao->findFirstBy($field, $value);
        
        $response
            ->getBody()
            ->write(json_encode([
                "status" => $status,
                "data" => $dataResponse
            ]));
    }
    
    public function update(Request $request, Response $response): void
    {
        $bodyRequest = $request->getParsedBody();
        
        $model = $this->fillModel($bodyRequest);

        $status = "fail";
        $dataResponse = $this->business->checkUpdate($model);

        if (empty($dataResponse)) {
            DAO::startTransaction();

            try {
                $this->dao->update($model);

                DAO::commitTransaction();

                $status = "success";
                $dataResponse = null;
            } catch (Exception $exception) {
                DAO::rollBackTransaction();

                $dataResponse = [
                    "Erro inesperado"
                ];
            }
        }

        $response
            ->getBody()
            ->write(json_encode([
                "status" => $status,
                "data" => $dataResponse
            ]));
    }
}