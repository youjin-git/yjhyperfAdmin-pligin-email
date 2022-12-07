<?php
/**
 * @Notes:【】
 * @Date: 2022-12-02 22:05
 */

namespace yjHyperfAdminPligin\Email;

use Psr\EventDispatcher\EventDispatcherInterface;
use yjHyperfAdminPligin\Email\Contracts\SendMessageResult;
use yjHyperfAdminPligin\Email\EmailConf;
use yjHyperfAdminPligin\Email\Driver\PHPMailerDriver;

class EmailManager
{
    protected array $data = [];

    protected $driver = null;
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->driver = $this->getDriver();
        $this->dispatcher = $dispatcher;
    }

    private function getDriver(): PHPMailerDriver
    {
        $driverClass = PHPMailerDriver::class;
        $driver = make($driverClass);
        return $driver;
    }

    public function getNewDriver(){
         return (new self(make(EventDispatcherInterface::class)));
    }

    public function __call(string $name, array $arguments)
    {
        $this->driver->{$name}(...$arguments);
        return $this->driver;
    }

    public function send():SendMessageResult
    {
         $result =  new SendMessageResult($this->driver->send(),$this->dispatcher,$this->getData());
         return $result->startEvent();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }


}