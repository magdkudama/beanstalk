<?php

namespace MagdKudama\Beanstalk\Consumers;

use MagdKudama\Beanstalk\Tubes;
use MagdKudama\Beanstalk\Consumers\AbstractConsumer;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

class EmailConsumer extends AbstractConsumer
{
    const REGISTER = 'registration';

    public function getTube()
    {
        return Tubes::TUBE_MAIL;
    }

    public function processJob()
    {
        $job = $this->getNextJob();
        $dataToProcess = json_decode($job->getData());

        $message = new Message();
        $message->addFrom('example@myapp.com')
                ->addTo($dataToProcess->to);

        switch ($dataToProcess->type) {
            case self::REGISTER:
                $message->setSubject("Thanks for registering")
                        ->setBody("Thanks for registering! Enjoy our website!");
                break;
        }

        $transport = new Sendmail();
        $transport->send($message);

        $this->pheanstalk->delete($job);
    }

}
