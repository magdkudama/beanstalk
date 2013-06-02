<?php

use MagdKudama\Beanstalk\Consumers\EmailConsumer;

require_once __DIR__ . '/../vendor/autoload.php';

$consumer = new EmailConsumer();

while(true) {
	$consumer->processJob();
}