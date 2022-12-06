<?php

namespace yjHyperfAdminPligin\Email\Driver;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use yjHyperfAdminPligin\Email\Conf\HostTrait;
use yjHyperfAdminPligin\Email\EmailConf;
use Psr\Container\ContainerInterface;

/**
 * @Notes:【】
 * @Date: 2022-12-02 22:05
 */
class PHPMailerDriver
{
    use HostTrait;

    private ContainerInterface $container;

    private PHPMailer $PHPMailer;
    private EmailConf $emailConf;

    public function __construct(EmailConf $emailConf)
    {
        $this->PHPMailer = $this->getPHPMailer($emailConf);
    }

    protected function setHost(){
        $this->PHPMailer->Host = $this->emailConf->getHost();
    }

    private function getPHPMailer($emailConf)
    {
        /** @var PHPMailer $PHPMailer */
        $PHPMailer = make(PHPMailer::class, ['exceptions' => true]);
        $emailConf->setConfig($PHPMailer);
        return $PHPMailer;
    }

    public function setAddress($email){
        $this->PHPMailer->addAddress($email);
        return $this;
    }

    public function setSubject($subject){
        $this->PHPMailer->Subject = $subject;
        return $this;
    }

    public function setBody($body){
        $this->PHPMailer->body = $body;
        return $this;
    }

    public function setHtml(){
        $this->PHPMailer->isHTML(true);
        return $this;
    }

    public function send()
    {
        $PHPMailer = $this->PHPMailer;
        $this->setHtml();
        return $PHPMailer->send();
    }
}