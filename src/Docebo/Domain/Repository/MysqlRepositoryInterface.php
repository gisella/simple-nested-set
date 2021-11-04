<?php

namespace Docebo\Domain\Repository;

use Docebo\Domain\Model\NodeArray;

interface MysqlRepositoryInterface
{

    public function getNodes(string $query, array $queryParameters): NodeArray;

}