<?php

use NestedSet\Domain\Model\NodeArray;
use NestedSet\Infrastructure\Repository\MysqlClient;
use NestedSet\Infrastructure\Repository\MysqlRepository;
use PHPUnit\Framework\TestCase;

final class MysqlRepositoryTest extends TestCase
{
    public function testGetNodes()
    {
        $query = 'SELECT * FROM test';
        $queryParameters = [];

        $mysqlResponse = [
            ['idNode' => 1, 'children' => 0, 'nodeName' => 'node 1'],
            ['idNode' => 2, 'children' => 1, 'nodeName' => 'node 2']
        ];

        // Mock del MysqlClient
        $mysqlClientMock = $this->createMock(MysqlClient::class);
        $mysqlClientMock
            ->expects($this->once())
            ->method('execPreparedStatement')
            ->with($query, $queryParameters)
            ->willReturn($mysqlResponse);

        // Crea MysqlRepository con client mockato
        $mysqlRepository = new MysqlRepository($mysqlClientMock);

        // Esegui il test
        $actual = $mysqlRepository->getNodes($query, $queryParameters);

        // Assertions
        self::assertNotEmpty($actual);
        self::assertInstanceOf(NodeArray::class, $actual);
        self::assertCount(2, $actual->getNodes());
    }
}