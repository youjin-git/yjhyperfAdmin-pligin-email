<?php

namespace yjHyperfAdminPligin\Email\Conf;

use yjHyperfAdminPligin\Email\Driver\PHPMailerDriver;
use yjHyperfAdminPligin\Email\Interfaces\MailerInterface;

trait DriverNameTrait
{
    private string $driver_name = PHPMailerDriver::class;

    /**
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->driver_name;
    }

    /**
     * @param string $driver
     */
    public function setDriverName(string|null $driver): void
    {
        $driver && $this->driver_name = $driver;
    }


}