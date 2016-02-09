<?php

namespace App\Controller\Provider;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Zend\Stratigility\Http\ResponseInterface;

interface JsonRendererInterface
{
    /**
     * Write data with JSON encode.
     *
     * @param  mixed $data The data
     * @param  int $encodingOptions Json encoding options
     *
     * @return self
     */
    public function render($data, $encodingOptions = 0);

    /**
     * Return response with JSON header and status.
     *
     * @param PsrResponseInterface|ResponseInterface $response
     * @param int $status
     * @return mixed
     */
    public function response($response, $status = 200);
}