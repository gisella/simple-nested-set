<?php

namespace NestedSet\Domain\Model;

class NodeArray
{
    private array $nodes = [];

    /**
     * @param int $nodeId
     * @param string $name
     * @param int $children
     * @return $this
     */
    public function addNode(int $nodeId, string $name, int $children): NodeArray
    {
        $this->nodes[] = ["nodeId" => $nodeId, "name" => $name, "children" => $children];
        return $this;
    }

    /**
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }


}