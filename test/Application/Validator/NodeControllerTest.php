<?php

use Docebo\Application\NodeController;
use PHPUnit\Framework\TestCase;

final class NodeControllerTest extends TestCase
{

    public function testListNodes()
    {
        $params = ['node_id' => 1, 'language' => 'italian', 'page_size' => 1];
        $testObj = new NodeController();
        $actual=$testObj->listNodes($params);
        self::assertJsonStringEqualsJsonString('{"nodes":[{"nodeId":5,"name":"NestedSet","children":11}],"error":""}', $actual->jsonSerialize());
    }

}
