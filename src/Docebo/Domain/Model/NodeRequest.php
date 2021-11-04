<?php

namespace Docebo\Domain\Model;

use Docebo\Domain\Model\Exception\InvalidPageNumberException;
use Docebo\Domain\Model\Exception\InvalidPageSizeException;
use Docebo\Domain\Model\Exception\MissingParamsException;

class NodeRequest
{
    const MIN_PAGE_SIZE = 0;
    const MAX_PAGE_SIZE = 1000;
    const DEFAULT_PAGE_SIZE = 100;

    /**
     * @param int $nodeId
     * @param string $language
     * @throws MissingParamsException
     */
    function __construct(int $nodeId, string $language)
    {
        if (empty($nodeId) || empty($language) || $nodeId<1) {
            throw new MissingParamsException();
        }
        $this->nodeId = $nodeId;
        $this->language = Language::from($language);
        $this->pageNum = 0;
        $this->pageSize = self::DEFAULT_PAGE_SIZE;
        $this->searchKeyword = '';
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return int
     */
    public function getNodeId(): int
    {
        return $this->nodeId;
    }

    /**
     * @return int
     */
    public function getPageNum(): int
    {
        return $this->pageNum;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return string
     */
    public function getSearchKeyword(): string
    {
        return $this->searchKeyword;
    }

    /**
     * @param string $searchKeyword
     * @return $this
     */
    public function setSearchKeyword(string $searchKeyword): NodeRequest
    {
        if (!empty($searchKeyword)) {
            $this->searchKeyword = $searchKeyword;
        }
        return $this;
    }

    /**
     * @param int $pageNum
     * @return $this
     * @throws InvalidPageNumberException
     */
    public function setPageNum(int $pageNum): NodeRequest
    {
        if($pageNum<0){
            throw new InvalidPageNumberException();
        }
        $this->pageNum = $pageNum;
        return $this;
    }

    /**
     * @param int $pageSize
     * @return NodeRequest
     * @throws InvalidPageSizeException
     */
    public function setPageSize(int $pageSize): NodeRequest
    {
        if (!$this->checkPageSizeRespectLimits($pageSize)) {
            throw new InvalidPageSizeException('Invalid Page Size Exception');
        }
        $this->pageSize = $pageSize;
        return $this;
    }

    private function checkPageSizeRespectLimits(int $pageSize): bool
    {
        return (is_int($pageSize) && $pageSize >= self::MIN_PAGE_SIZE && $pageSize <= self::MAX_PAGE_SIZE);
    }

    public function existsSearchKeyword():bool
    {
        return !empty($this->getSearchKeyword());
    }
}