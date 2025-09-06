<?php

namespace NestedSet\Application;

use NestedSet\Application\Validator\NodeRequestValidator;
use NestedSet\Domain\Model\Exception\NestedSetException;
use NestedSet\Domain\Model\NodeResponse;
use NestedSet\Domain\Model\QueryBuilder;
use NestedSet\Infrastructure\Repository\MysqlRepository;
use Throwable;

class NodeController
{

    public function listNodes($inputParams): NodeResponse
    {
        $nodeResponse = new NodeResponse();
        try {
            $validator = new NodeRequestValidator($inputParams);
            $nodeRequest = $validator->getNodeRequest();

            $queryBuilder = new QueryBuilder($nodeRequest);
            $query = $queryBuilder->getQuery();
            $queryParameters = $queryBuilder->getQueryParameters();
            $repository = new MysqlRepository();
            $nodeArray = $repository->getNodes($query, $queryParameters);
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