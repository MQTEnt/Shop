<?php
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/../src/');

require_once __DIR__.'/../lib/Pragmatic/Boostrap.php';

$bootstrap = new Pragmatic\Bootstrap();
$bootstrap->setDbCredentials('localhost', 'root', '', 'pc_shop');
$bootstrap->setDefaultController('index');
$bootstrap->setTplPath(__DIR__.'/../templates/frontend');
$bootstrap->setMainTpl('main.php');
$bootstrap->setAppUrlPrefix('');
$bootstrap->setDefaultAppNS('\\App\\FrontEnd\\');
$bootstrap->run();