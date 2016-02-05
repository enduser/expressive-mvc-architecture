<?php

namespace App\Controller;

use FastRoute\BadRouteException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;
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
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
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