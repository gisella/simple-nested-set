<?php

use Docebo\Application\Validator\NodeRequestValidator;
use Docebo\Domain\Model\Exception\InvalidNodeException;
use Docebo\Domain\Model\Exception\MissingParamsException;
use PHPUnit\Framework\TestCase;

final class NodeRequestValidatorTest extends TestCase
{

    public function testGetNodeRequestThrowInvalidParamsException()
    {
        $this->expectException(InvalidNodeException::class);
        $this->expectExceptionMessage('Node id not found');

        $params = [];
        $testObj = new NodeRequestValidator($params);
        $testObj->getNodeRequest();
    }

    public function testGetNodeRequestThrowMissingParamsException()
    {
        $this->expectException(MissingParamsException::class);

        $params = ["node_id" => 1];
        $testObj = new NodeRequestValidator($params);
        $testObj->getNodeRequest();
    }

    public function testGetNodeRequestThrowInvalidPageSizeException()
    {
        $this->expectException(\Docebo\Domain\Model\Exception\InvalidPageSizeException::class);

        $params = ["node_id"=>1,'language'=>'italian','page_size'=>-1];
        $testObj = new NodeRequestValidator($params);
        $testObj->getNodeRequest();
    }


    public function testGetNodeRequest3()
    {
        $params = ["node_id" => 1, "language" => "spanish", "page_size" => 25];
        $testObj = new NodeRequestValidator($params);
        $actual = $testObj->getNodeRequest();
        self::assertEquals($actual->getNodeId(), $params['node_id']);
        self::assertEquals($actual->getPageSize(), $params['page_size']);
    }
}
