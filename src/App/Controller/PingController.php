<?php

namespace App\Controller;

use App\Controller\Provider\JsonRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Http\ResponseInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class PingController extends AbstractController
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var JsonRendererInterface */
    private $json;

    /**
     * PingController constructor.
     *
     * @param TemplateRendererInterface|null $template
     * @param JsonRendererInterface $json
     */
    public function __construct(TemplateRendererInterface $template = null, JsonRendererInterface $json)
    {
        $this->template = $template;
        $this->json = $json;
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

        return $response->write($this->template->render('app::ping', compact('dump')));
    }

    /**
     * Ping action.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return string
     */
    public function ping(ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = [
            'ack' => time(),
            'target' => __METHOD__
        ];

        $response->write($this->json->render($data));

        return $this->json->response($response);
    }
}