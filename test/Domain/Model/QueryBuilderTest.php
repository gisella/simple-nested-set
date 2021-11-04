<?php

use Docebo\Domain\Model\Language;
use Docebo\Domain\Model\NodeRequest;
use Docebo\Domain\Model\QueryBuilder;
use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{
    private QueryBuilder $testObj;

    protected function setUp(): void
    {
        parent::setUp();
        $nodeRequest = new NodeRequest(1, Language::ITALIAN);
        $nodeRequest->setPageSize(10)
        ->setSearchKeyword('searchKeyword');
        $this->testObj = new QueryBuilder($nodeRequest);
    }


    public function testGetQueryParameters()
    {
        $nodeRequest = new NodeRequest(1, Language::ITALIAN);
        $nodeRequest->setPageSize(10)
            ->setPageNum(0);
        $testObj = new QueryBuilder($nodeRequest);
        $actual = $testObj->getQueryParameters();
        self::assertEquals(count($actual), 2);

        //one more param
        $nodeRequest->setSearchKeyword('searchKeyword');
        $testObj = new QueryBuilder($nodeRequest);
        $actual=$testObj->getQueryParameters();
        self::assertEquals(count($actual), 3);
    }

    public function testGetQuery(){
        $actual=$this->testObj->getQuery();
        self::assertStringContainsString(':searchKeyword',$actual,'search keyword is set');
        self::assertStringContainsString('LIMIT',$actual,'limit is set');
        self::assertStringContainsString('LIMIT 0,10',$actual,'limit is set');

        $nodeRequest = new NodeRequest(1, Language::ITALIAN);
        $nodeRequest->setPageSize(10)
            ->setPageNum(2);
        $this->testObj= new QueryBuilder($nodeRequest);
        $actual=$this->testObj->getQuery();
        self::assertStringNotContainsStringIgnoringCase(':searchKeyword',$actual,'search keyword is not set');
        self::assertStringContainsString('LIMIT',$actual,'limit is set');
        self::assertStringContainsString('LIMIT 20,30',$actual,'limit is set');
    }

}
