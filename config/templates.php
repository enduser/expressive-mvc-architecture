<?php

return [
    'dependencies' => [
        'factories' => [
            'Zend\Expressive\FinalHandler' => Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,
            Zend\Expressive\Template\TemplateRendererInterface::class =>
                Zend\Expressive\Twig\TwigRendererFactory::class,
        ],
    ],

    'templates' => [
        'extension' => 'html.twig',
        'paths' => [
            'app' => ['src/App/view/app'],
            'layout' => ['src/App/view/layout'],
            'error' => ['src/App/view/error'],
        ],
    ],

    'twig' => [
        'cache_dir' => 'data/cache/twig',
        'assets_url' => '/assets/',
        'assets_version' => null,
        'extensions' => [
            // extension service names or instances
        ],
    ],
];
