<?php

namespace Docebo\Application\Validator;

use Docebo\Domain\Model\Exception\InvalidNodeException;
use Docebo\Domain\Model\Exception\MissingParamsException;
use Docebo\Domain\Model\NodeRequest;

class NodeRequestValidator extends RequestValidator
{
    private array $mandatoryParams;

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->mandatoryParams = ['node_id', 'language'];
    }

    /**
     * return a model object with all the params from http request
     *
     * @return NodeRequest
     * @throws InvalidNodeException
     * @throws MissingParamsException
     * @throws \Docebo\Domain\Model\Exception\InvalidPageSizeException
     */
    public function getNodeRequest(): NodeRequest
    {
        $this->validateRequest();
        $request = new NodeRequest($this->getParam('node_id'), $this->getParam('language'));

        if ($this->paramExists('search_keyword')) {
            $request->setSearchKeyword($this->getParam('search_keyword'));
        }
        if ($this->paramExists('page_num')) {
            $request->setPageNum($this->getParam('page_num'));
        }
        if ($this->paramExists('page_size')) {
            $request->setPageSize($this->getParam('page_size'));
        }
        return $request;
    }

    /**
     * check that mandatory params are set
     * @throws InvalidNodeException
     * @throws MissingParamsException
     */
    private function validateRequest()
    {
        if (!$this->paramExists('node_id')) {
            throw new InvalidNodeException('Node id not found');
        }
        if (!$this->checkMandatoryParams($this->mandatoryParams)) {
            throw new MissingParamsException();
        }
    }
}