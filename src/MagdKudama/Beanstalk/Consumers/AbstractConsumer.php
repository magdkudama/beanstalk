<?php

namespace MagdKudama\Beanstalk\Consumers;

use MagdKudama\Beanstalk\Tubes;

abstract class AbstractConsumer {

	protected $pheanstalk;

	public function __construct($host = '127.0.0.1') {
		$this->pheanstalk = new \Pheanstalk_Pheanstalk($host);
	}

	protected function getNextJob() {
		$job = $this->pheanstalk
					->watch($this->getTube())
					->ignore(Tubes::TUBE_DEFAULT)
					->reserve();

		return $job;
	}

	abstract public function processJob();
	abstract public function getTube();

}