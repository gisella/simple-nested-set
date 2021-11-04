<?php

namespace Docebo\Application;

class HttpResponse
{
    /**
     * @param int $status
     * @param $model
     */
    function sendResponseAsJson(int $status, $model): void
    {
        $response = null;
        if (isset($model)) {
            $this->setHeader('Content-type:application/json;charset=utf-8');
            $response = json_encode($model->jsonSerialize());
        }
        $this->sendResponse($status, $response);
    }

    /**
     * @param int $status
     * @param string $response
     */
    function sendResponse(int $status, string $response): void
    {
        echo $response;
        http_response_code($status);
    }

    /**
     * @param string $header
     */
    function setHeader(string $header): void
    {
        header($header);
    }
}