<?php

namespace NestedSet\Domain\Repository;

use NestedSet\Domain\Model\NodeArray;

interface MysqlRepositoryInterface
{

    public function getNodes(string $query, array $queryParameters): NodeArray;

}