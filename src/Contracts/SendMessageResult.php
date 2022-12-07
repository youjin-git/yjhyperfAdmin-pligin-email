<?php

namespace yjHyperfAdminPligin\Email\Contracts;

use Psr\EventDispatcher\EventDispatcherInterface;
use yjHyperfAdminPligin\Email\Interfaces\MailerInterface;

class SendMessageResult
{

    private MailerInterface $mailer;
    private EventDispatcherInterface $dispatcher;
    private array $data;

    public function __construct(MailerInterface $mailer,EventDispatcherInterface $dispatcher,$data=[])
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
        $this->data = $data;
    }

    public function getStatus():bool
    {
        return $this->mailer->getStatus();
    }

    public function getData():array
    {
        return $this->data;
    }

    public function getErrorMessage():string
    {
        return $this->mailer->getErrorMessage();
    }

    public function getEmail():string
    {
        return $this->mailer->getEmail();
    }

    public function startEvent(){
        $this->dispatcher->dispatch(new EmailSendEvent($this->getStatus(),$this->getEmail(),$this->getData()));
        return $this;
    }

}