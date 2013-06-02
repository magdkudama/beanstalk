<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;
use MagdKudama\Beanstalk\Producer;
use MagdKudama\Beanstalk\Tubes;

require_once __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$message = json_encode(array(
	'to'	=> $request->query->get('mail'),
	'type'	=> 'registration'
));

Producer::addToQueue(Tubes::TUBE_MAIL, $message);