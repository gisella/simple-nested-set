<?php

namespace NestedSet\Infrastructure\Repository;

use NestedSet\Domain\Model\Config;
use NestedSet\Domain\Model\NodeArray;
use NestedSet\Domain\Repository\MysqlRepositoryInterface;

class MysqlRepository implements MysqlRepositoryInterface
{
    private MysqlClient $mysqlClient;

    /**
     * @throws \NestedSet\Domain\Model\Exception\DatabaseConnectionException
     */
    function __construct()
    {
        $config = Config::getInstance();
        $this->mysqlClient = new MysqlClient($config->get('dbUrl'), $config->get('dbUsername'), $config->get('dbPassword'));
    }

    /**
     * @param string $query
     * @param array $queryParameters
     * @return NodeArray
     */
    public function getNodes(string $query, array $queryParameters): NodeArray
    {
        $results = $this->mysqlClient->execPreparedStatement($query, $queryParameters);
        $nodeArray = new NodeArray();
        foreach ($results as $result) {
            $nodeArray->addNode($result['idNode'], $result['nodeName'], $result['children']);
        }
        return $nodeArray;
    }

}