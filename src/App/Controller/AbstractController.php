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
}