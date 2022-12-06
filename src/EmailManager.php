<?php
/**
 * @Notes:【】
 * @Date: 2022-12-02 22:05
 */

namespace yjHyperfAdminPligin\Email;

use yjHyperfAdminPligin\Email\EmailConf;
use yjHyperfAdminPligin\Email\Driver\PHPMailerDriver;

class EmailManager
{

    protected $driver = null;

    public function __construct()
    {
        $this->driver = $this->getDriver();
    }

    private function getDriver(): PHPMailerDriver
    {
        $driverClass = PHPMailerDriver::class;
        $driver = make($driverClass);
        return $driver;
    }

    public function getNewDriver(){
         return (new self());
    }

    public function __call(string $name, array $arguments)
    {
        $this->driver->{$name}(...$arguments);
        return $this->driver;
    }
}