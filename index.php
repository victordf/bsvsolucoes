<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 07/09/16
 * Time: 17:58
 */

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;


require_once 'vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => 'app/view'
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'      => 'pdo_mysql',
        'host'        => "localhost",
        'dbname'      => "bsv",
        'user'        => "root",
        'password'    => "123456",
        'charset'     => 'utf8mb4'
    )
));

$app['twig']->addGlobal('RAIZ', '/bsvsolucoes/');

$app->get('/', function() use($app){
    return $app['twig']->render('pages/home.twig');
});

$app->run();