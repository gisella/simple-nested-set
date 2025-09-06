<?php

namespace NestedSet\Application;

use NestedSet\Application\Validator\NodeRequestValidator;
use NestedSet\Domain\Model\Exception\NestedSetException;
use NestedSet\Domain\Model\NodeResponse;
use NestedSet\Domain\Model\QueryBuilder;
use NestedSet\Domain\Repository\MysqlRepositoryInterface;
use NestedSet\Infrastructure\Repository\MysqlRepository;
use Throwable;

class NodeController
{
    private MysqlRepositoryInterface $repository;

    public function __construct(?MysqlRepositoryInterface $repository = null)
    {
        $this->repository = $repository ?? new MysqlRepository();
    }

    public function listNodes($inputParams): NodeResponse
    {
        $nodeResponse = new NodeResponse();
        try {
            $validator = new NodeRequestValidator($inputParams);
            $nodeRequest = $validator->getNodeRequest();

            $queryBuilder = new QueryBuilder($nodeRequest);
            $query = $queryBuilder->getQuery();
            $queryParameters = $queryBuilder->getQueryParameters();

            $nodeArray = $this->repository->getNodes($query, $queryParameters);
            $nodeResponse->setNodes($nodeArray->getNodes());
        } catch (NestedSetException $e) {
            $nodeResponse->setError($e->getMessage());
        } catch (Throwable $e) {
            error_log($e->getMessage() . "-" . $e->getTraceAsString());
            $nodeResponse->setError('Internal Server Error');
        }
        return $nodeResponse;
    }
}