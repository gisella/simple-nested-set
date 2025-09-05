<?php

use NestedSet\Domain\Model\Exception\InvalidPageNumberException;
use NestedSet\Domain\Model\Exception\InvalidPageSizeException;
use NestedSet\Domain\Model\Exception\MissingParamsException;
use NestedSet\Domain\Model\Language;
use NestedSet\Domain\Model\NodeRequest;
use PHPUnit\Framework\TestCase;

final class NodeRequestTest extends TestCase
{

    public function testConstructorLanguage(){
        $this->expectException(MissingParamsException::class,'exception if language is not defined');
        new NodeRequest(0,'');
    }
    public function testConstructorNodeId(){
        $this->expectException(MissingParamsException::class,'exception if nodeId is not defined');
        new NodeRequest(-1,'french');
    }

    public function testSetSearchKeyword()
    {
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        $nodeRequest->setSearchKeyword('');
        self::assertEmpty($nodeRequest->getSearchKeyword());

        $nodeRequest->setSearchKeyword('hi');
        self::assertNotEmpty($nodeRequest->getSearchKeyword());
        self::assertEquals($nodeRequest->getSearchKeyword(),'hi');
    }

    public function testSetPageNumberException()
    {
        $this->expectException(InvalidPageNumberException::class,'exception if page number is < 0');
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        $nodeRequest->setPageNum('-1');
    }

    public function testSetPageNumber()
    {
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        $nodeRequest->setPageNum('1');
        self::assertEquals($nodeRequest->getPageNum(),1);
    }



    public function testSetPageSizeException()
    {
        $this->expectException(InvalidPageSizeException::class,'exception if page number is < 0');
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        $nodeRequest->setPageSize('-1');
    }
    public function testSetPageSizeLimitException()
    {
        $this->expectException(InvalidPageSizeException::class,'exception if page number is < 0');
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        $nodeRequest->setPageSize(1000000);
    }

    public function testSetPageSize()
    {
        $nodeRequest=new NodeRequest(1,Language::ITALIAN);
        self::assertEquals($nodeRequest->getPageSize(),100);

        $nodeRequest->setPageSize(10);
        self::assertEquals($nodeRequest->getPageSize(),10);
    }


}
