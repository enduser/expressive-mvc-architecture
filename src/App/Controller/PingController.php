<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class PingController extends AbstractController
{
    private $template;

    /**
     * IndexController constructor.
     *
     * @param TemplateRendererInterface|null $template
     */
    public function __construct(TemplateRendererInterface $template = null)
    {
        $this->template = $template;
    }

    /**
     * Test action.
     *
     * @param $request
     * @return HtmlResponse
     */
    public function dump(ServerRequestInterface $request)
    {
        $dump = print_r($this->template, true);

        return new HtmlResponse($this->template->render('app::ping', compact('dump')));
    }

    /**
     * Ping action.
     *
     * @return JsonResponse
     */
    public function ping()
    {
        return new JsonResponse([
            'ack' => time(),
            'target' => __METHOD__
        ]);
    }
}