<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Zend\Expressive\Router\RouteResult;
use FastRoute\BadRouteException;
use ReflectionMethod;

/**
 * Abstract Controller.
 *
 * @package App\Controller
 */
abstract class AbstractController
{
    /**
     * Invoke action controller.
     *
     * @param ServerRequestInterface $request
     * @param PsrResponseInterface $response
     * @param callable|null $next
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, PsrResponseInterface $response, callable $next = null)
    {
        $name = $this->getMatchedRouteName($request);

        $reflection = new ReflectionMethod($this, $name);
        $reflection->setAccessible(true);

        return $reflection->invoke($this, $request, $response, $next);
    }

    /**
     * Get matched route name.
     *
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function getMatchedRouteName(ServerRequestInterface $request)
    {
        // Get route result
        $route = $request->getAttribute(RouteResult::class);

        // Check method route name exist
        if (false === method_exists($route, 'getMatchedRouteName')) {
            // Show Exception
            throw new BadRouteException('Route name does not exist');
        }

        // Get route name
        return $route->getMatchedRouteName();
    }

    /**
     * Json encode.
     *
     * Note: This method is not part of the PSR-7 standard.
     *
     * @param PsrResponseInterface $response
     * @param  mixed $data The data
     * @param  int $status The HTTP status code.
     * @param  int $encodingOptions Json encoding options
     * @return \Psr\Http\Message\MessageInterface
     */
    public function withJson(PsrResponseInterface $response, $data, $status = 200, $encodingOptions = 0)
    {
        $body = $response->getBody();
        $body->rewind();
        $body->write($json = json_encode($data, $encodingOptions));

        // Ensure that the json encoding passed successfully
        if ($json === false) {
            throw new \RuntimeException(json_last_error_msg(), json_last_error());
        }

        return $response->withStatus($status)->withHeader('Content-Type', 'application/json;charset=utf-8');
    }
}