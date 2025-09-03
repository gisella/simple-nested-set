<?php

namespace NestedSet\Domain\Model;

class QueryBuilder
{
    private NodeRequest $nodeRequest;

    function __construct(NodeRequest $request)
    {
        $this->nodeRequest = $request;
    }

    /**
     * return an array containing values
     * for the prepared statement
     * @return array
     */
    public function getQueryParameters(): array
    {
        $parameters = [":nodeId" => $this->nodeRequest->getNodeId(),
            ":language" => $this->nodeRequest->getLanguage()];
        if ($this->nodeRequest->existsSearchKeyword()) {
            $parameters[":searchKeyword"] = '%' . $this->nodeRequest->getSearchKeyword() . '%';
        }
        return $parameters;
    }

    /**
     * return a query for the mysql prepared statement
     * @return string
     */
    function getQuery(): string
    {
        $subQueryNodeChildren =
            'SELECT parent.idNode, count(parent.idNode)-1 as children
             FROM node_tree AS node,
                  node_tree AS parent
             WHERE node.iLeft BETWEEN parent.iLeft AND parent.iRight
             group by parent.idNode';

        return
            'SELECT node.idNode, sub_tree.level,sub_tree.nodeName, node_childrens.children
            FROM node_tree AS node,
                 node_tree AS parent,
                 node_tree AS sub_parent,
                 (' . $this->getQuerySubTree() . ') AS sub_tree,
                 (' . $subQueryNodeChildren . ') AS node_childrens
            WHERE node.iLeft BETWEEN parent.iLeft AND parent.iRight
              AND node.iLeft BETWEEN sub_parent.iLeft AND sub_parent.iRight
              and node.idNode=sub_tree.idNode
            and node.idNode=node_childrens.idNode
            group by node.idNode,sub_tree.level,sub_tree.nodeName
            HAVING sub_tree.level <= 1
            ORDER BY sub_tree.level'
            . $this->getLimit($this->nodeRequest->getPageNum(), $this->nodeRequest->getPageSize());
    }

    private function getQuerySubTree()
    {
        $subQuerySubTree =
            "SELECT node.idNode,(node.level-1) as level, node_tree_names.nodeName
             FROM node_tree AS node,
                  node_tree AS parent,
                   node_tree_names
             WHERE node.iLeft BETWEEN parent.iLeft AND parent.iRight
               and node.idNode=node_tree_names.idNode
               AND parent.idNode = :nodeId and language= :language";
        if ($this->nodeRequest->existsSearchKeyword()) {
            $subQuerySubTree .= ' and nodeName like :searchKeyword';
        }
        return $subQuerySubTree;
    }

    /**
     * return the limit string for the query
     * @param $pageNum
     * @param $pageSize
     * @return string
     */
    private function getLimit($pageNum, $pageSize): string
    {
        $startLimit = $this->getStartLimit($pageNum, $pageSize);
        $endLimit = $this->getEndLimit($pageNum, $pageSize);
        return ' LIMIT ' . $startLimit . "," . $endLimit;
    }

    private function getStartLimit($pageNum, $pageSize)
    {
        return 0 + ($pageSize * $pageNum);
    }

    private function getEndLimit($pageNum, $pageSize)
    {
        return $this->getStartLimit($pageNum, $pageSize) + $pageSize;
    }

}