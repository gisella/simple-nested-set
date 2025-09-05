<?php

use NestedSet\Domain\Model\Config;
use NestedSet\Domain\Model\NodeArray;
use NestedSet\Infrastructure\Repository\MysqlClient;
use NestedSet\Infrastructure\Repository\MysqlRepository;
use PHPUnit\Framework\TestCase;

final class MysqlRepositoryTest extends TestCase
{

    public function testGetNodes()
    {
        $query='seelct * from test';
        $queryParameters=[];

        $mysqlResponse=[['idNode'=>1,'children'=>0, 'name'=>'node 1'],
            ['idNode'=>2, 'children'=>1,'name'=>'node 2']];

        $stub = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        // Configure the stub.
        $stub->method('get')
            ->willReturn('value');


        $msqlClient = $this->getMockBuilder(MysqlClient::class)
            ->disableOriginalConstructor()
            ->disableProxyingToOriginalMethods()
            ->disableOriginalClone()
        ->getMock();
        $msqlClient
            ->expects($this->once())
            ->method('execPreparedStatement')
            ->with($this->equalTo($query),$this->equalTo($queryParameters))
            ->willReturn($mysqlResponse);

        $testObj=new MysqlRepository($query,$queryParameters);
        $actual=$testObj->getNodes($query,$queryParameters);
        self::assertNotEmpty($actual);
        self::assertInstanceOf(NodeArray::class, $actual);
        //self::assertEqEquals($actual->getNodes(),);
    }

}
