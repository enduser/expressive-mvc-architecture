<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Http\ResponseInterface;
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
     * @return int
     */
    public function home(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = [
            'routerName' => 'FastRoute',
            'routerDocs' => 'https://github.com/nikic/FastRoute',
            'templateName' => 'Twig',
            'templateDocs' => 'http://twig.sensiolabs.org/documentation'
        ];

        $response->write($this->template->render('app::index', $data));

        return $response;
    }
}