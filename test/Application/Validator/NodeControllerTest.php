<?php

use NestedSet\Application\NodeController;
use NestedSet\Domain\Model\NodeArray;
use NestedSet\Domain\Repository\MysqlRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class NodeControllerTest extends TestCase
{
    public function testListNodes()
    {
        // Arrange
        $params = ['node_id' => 1, 'language' => 'italian', 'page_size' => 1];

        // Mock del repository che ritorna dati specifici
        $repositoryMock = $this->createMock(MysqlRepositoryInterface::class);

        $expectedNodeArray = new NodeArray();
        $expectedNodeArray->addNode(5, "NestedSet", 11);

        $repositoryMock
            ->expects($this->once())
            ->method('getNodes')
            ->with($this->isType('string'), $this->isType('array'))
            ->willReturn($expectedNodeArray);

        // Act
        $nodeController = new NodeController($repositoryMock);
        $actual = $nodeController->listNodes($params);

        // Assert
        $expectedJson = '{"nodes":[{"nodeId":5,"name":"NestedSet","children":11}],"error":""}';
        $actualJson = json_encode($actual->jsonSerialize());

        self::assertJsonStringEqualsJsonString($expectedJson, $actualJson);
    }

    public function testListNodesWithInvalidNodeId()
    {
        // Arrange
        $params = []; // Parametri mancanti

        $repositoryMock = $this->createMock(MysqlRepositoryInterface::class);
        $repositoryMock->expects($this->never())->method('getNodes');

        // Act
        $nodeController = new NodeController($repositoryMock);
        $actual = $nodeController->listNodes($params);

        // Assert
        $actualJson = json_encode($actual->jsonSerialize());
        $result = json_decode($actualJson, true);

        self::assertNotEmpty($result['error']);
        self::assertEmpty($result['nodes']);
    }
}