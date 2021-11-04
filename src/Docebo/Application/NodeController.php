<?php

namespace Docebo\Application;

use Docebo\Application\Validator\NodeRequestValidator;
use Docebo\Domain\Model\Exception\DoceboException;
use Docebo\Domain\Model\NodeResponse;
use Docebo\Domain\Model\QueryBuilder;
use Docebo\Infrastructure\Repository\MysqlRepository;

class NodeController
{

    public function listNodes($inputParams): NodeResponse
    {
        $nodeResponse=new NodeResponse();
        try {
            $validator = new NodeRequestValidator($inputParams);
            $nodeRequest = $validator->getNodeRequest();

            $queryBuilder = new QueryBuilder($nodeRequest);
            $query = $queryBuilder->getQuery();
            $queryParameters = $queryBuilder->getQueryParameters();
            $repository = new MysqlRepository();
            $nodeArray = $repository->getNodes($query, $queryParameters);
            $nodeResponse->setNodes($nodeArray->getNodes());
        } catch (DoceboException $e) {
            $nodeResponse->setError($e->getMessage());
        } catch (\Throwable $e) {
            //echo $e->getMessage() . "-" . $e->getTraceAsString();
            $nodeResponse->setError('Internal Server Error');
        }
        return $nodeResponse;
    }
}