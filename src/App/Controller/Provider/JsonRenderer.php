<?php

namespace App\Controller\Provider;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Zend\Stratigility\Http\ResponseInterface;
use InvalidArgumentException;

class JsonRenderer implements JsonRendererInterface
{
    /**
     * Write data with JSON encode.
     *
     * @param  mixed $data The data
     * @param  int $encodingOptions Json encoding options
     *
     * @return self
     */
    public function render($data, $encodingOptions = 0)
    {
        return $this->jsonEncode($data, $encodingOptions);
    }

    /**
     * Return response with JSON header and status.
     *
     * @param PsrResponseInterface|ResponseInterface $response
     * @param int $status
     * @return mixed
     */
    public function response($response, $status = 200)
    {
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json;charset=utf-8');
    }

    /**
     * Encode the provided data to JSON.
     *
     * @param mixed $data
     * @param int $encodingOptions
     * @return string
     * @throws InvalidArgumentException if unable to encode the $data to JSON.
     */
    private function jsonEncode($data, $encodingOptions)
    {
        if (is_resource($data)) {
            throw new InvalidArgumentException('Cannot JSON encode resources');
        }

        // Clear json_last_error()
        json_encode(null);

        $json = json_encode($data, $encodingOptions);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException(sprintf(
                'Unable to encode data to JSON in %s: %s',
                __CLASS__,
                json_last_error_msg()
            ));
        }

        return $json;
    }
}