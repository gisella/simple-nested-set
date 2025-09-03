<?php

use NestedSet\Application\NodeController;
use NestedSet\Application\HttpResponse;

$path = $_GET['path']??'';
if (empty($path) || strpos($path, 'api') === false) {
    echo file_get_contents('./searchNodes.html');
} else {
    require_once('../autoload.php');
    try {
        $nodeController = new NodeController();
        $nodeResponse = $nodeController->listNodes($_GET);
        $httpResponse = new HttpResponse();
        $httpResponse->sendResponseAsJson(200, $nodeResponse);
    }catch (Exception $e){
        echo $e->getMessage();
    }
}