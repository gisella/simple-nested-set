<?php

use Docebo\Application\NodeController;
use Docebo\Application\HttpResponse;

$path = $_GET['path'];
if (strpos($path, 'api') === false) {
    echo file_get_contents('./searchNodes.html');
} else {
    require_once('../autoload.php');
    $nodeController = new NodeController();
    $nodeResponse = $nodeController->listNodes($_GET);
    $httpResponse = new HttpResponse();
    $httpResponse->sendResponseAsJson(200, $nodeResponse);
}