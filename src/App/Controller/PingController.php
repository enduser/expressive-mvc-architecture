<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Zend\Stratigility\Http\ResponseInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PingController extends AbstractController
{
    /** @var TemplateRendererInterface */
    private $template;

    /**
     * PingController constructor.
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
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function dump(ServerRequestInterface $request, ResponseInterface $response)
    {
        $dump = print_r($this->template, true);

        $response->write($this->template->render('app::ping', compact('dump')));

        return $response;
    }

    /**
     * Ping action.
     *
     * @param ServerRequestInterface $request
     * @param PsrResponseInterface $response
     * @return string
     */
    public function ping(ServerRequestInterface $request, PsrResponseInterface $response)
    {
        $data = [
            'ack' => time(),
            'target' => __METHOD__
        ];

        return $this->withJson($response, $data);
    }
}