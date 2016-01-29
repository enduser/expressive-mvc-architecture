<?php

define('ROOT_PATH', dirname(__DIR__));
define('DATA_PATH', ROOT_PATH . '/data');
define('CACHE_PATH', DATA_PATH . '/cache');
define('LOG_PATH', DATA_PATH . '/log');

// Delegate static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server'
    && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
    return false;
}

chdir(dirname(__DIR__));

require ROOT_PATH . '/vendor/autoload.php';

/** @var \Interop\Container\ContainerInterface $container */
$container = require ROOT_PATH . '/config/container.php';

/** @var \Zend\Expressive\Application $app */
$app = $container->get('Zend\Expressive\Application');

$app->run();