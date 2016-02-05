<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class IndexController extends AbstractController
{
    private $router;

    private $template;

    /**
     * IndexController constructor.
     *
     * @param RouterInterface $router
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(RouterInterface $router, TemplateRendererInterface $template = null)
    {
        $this->router = $router;
        $this->template = $template;
    }

    /**
     * Index action.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse|JsonResponse
     */
    public function home(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = [];

        $data['routerName'] = 'FastRoute';
        $data['routerDocs'] = 'https://github.com/nikic/FastRoute';

        $data['templateName'] = 'Twig';
        $data['templateDocs'] = 'http://twig.sensiolabs.org/documentation';

        if (!$this->template) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the zend-expressive skeleton application.',
                'docsUrl' => 'zend-expressive.readthedocs.org',
            ]);
        }

        return new HtmlResponse($this->template->render('app::index', $data));
    }
}
