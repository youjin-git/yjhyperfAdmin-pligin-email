<?php
/**
 * @Notes:【】
 * @Date: 2022-12-02 22:05
 */

namespace yjHyperfAdminPligin\Email;

use Hyperf\Contract\ConfigInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use yjHyperfAdminPligin\Email\Contracts\SendMessageResult;
use yjHyperfAdminPligin\Email\Interfaces\MailerInterface;

class EmailManager
{
    protected $name = 'default';

    protected array $data = [];

    protected ?MailerInterface $driver = null;

    protected EventDispatcherInterface $dispatcher;
    protected EmailConf $emailConf;

    public function __construct(EventDispatcherInterface $dispatcher,EmailConf $emailConf)
    {
        $this->dispatcher = $dispatcher;
        $this->emailConf = $emailConf;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function driver(): self
    {
        $this->driver = $this->emailConf->getDriver($this->getName());
        return $this;
    }

//    public function getNewDriver(){
//         return (new self(app(EventDispatcherInterface::class)));
//    }

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