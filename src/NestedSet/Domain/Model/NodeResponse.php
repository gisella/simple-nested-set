<?php

namespace NestedSet\Domain\Model;

use JsonSerializable;

class NodeResponse implements JsonSerializable
{
    private array $nodes = [];
    private string $error = '';

    /**
     * @param array $nodes
     * @return $this
     */
    public function setNodes(array $nodes): NodeResponse
    {
        $this->nodes = $nodes;
        return $this;
    }

    /**
     * @param string $error
     * @return $this
     */
    public function setError(string $error): NodeResponse
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return ["nodes" => $this->nodes,
            "error" => $this->error];
    }

}