<?php

namespace App\Controller;

use App\Model\User;
use App\Controller\Provider\JsonRendererInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Stratigility\Http\ResponseInterface;

class UserController extends AbstractController
{
    /** @var JsonRendererInterface */
    private $json;

    /** @var User $user */
    private $user;

    /**
     * UserController constructor.
     *
     * @param JsonRendererInterface $json
     * @param User $user
     */
    public function __construct(JsonRendererInterface $json, User $user = null)
    {
        $this->json = $json;
        $this->user = $user
            ->setId(1)
            ->setName('Anderson Costa')
            ->setEmail('arcostasi@gmail.com')
            ->setPassword('123')
            ->setCreated(new \DateTime())
            ->setUpdated(new \DateTime());
    }

    /**
     * Show user.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\MessageInterface
     */
    public function user(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->write($this->json->render($this->user->toArray()));

        return $this->json->response($response);
    }
}