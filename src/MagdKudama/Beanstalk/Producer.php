<?php

namespace MagdKudama\Beanstalk;

class Producer
{
    public static function addToQueue($tube, $message, $host = '127.0.0.1')
    {
        $pheanstalk = new \Pheanstalk_Pheanstalk($host);
        $pheanstalk ->useTube($tube)
                    ->put($message);
    }
}
