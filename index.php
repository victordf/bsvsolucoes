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
use Bsv\Email;

require_once 'vendor/autoload.php';
require_once 'app/class/Email.class.php';

$app = new Application();
$email = new Email();

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
$app['twig']->addGlobal('SLOGAN', 'Um mundo de soluções a seu favor!');

$app->get('/', function() use($app){
    return $app['twig']->render('pages/home.twig');
});

$app->get('email', function() use($app, $email){
    $email->addEmailTo(array('Victor Martins' => 'victormachado90@gmail.com'));
    $assunto = 'Teste de email';
    $corpo = 'Bora ver se vai';

    if(!$email->send($assunto, $corpo)){
        return $email->error;
    } else {
        return 'FOI CARAI!';
    }
});

$app->run();