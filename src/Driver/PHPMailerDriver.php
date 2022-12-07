<?php

namespace yjHyperfAdminPligin\Email\Driver;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use plugin\email\src\Contracts\SendMessageResult;
use yjHyperfAdminPligin\Email\Conf\HostTrait;
use yjHyperfAdminPligin\Email\EmailConf;
use Psr\Container\ContainerInterface;
use yjHyperfAdminPligin\Email\Interfaces\MailerInterface;

/**
 * @Notes:【】
 * @Date: 2022-12-02 22:05
 */
class PHPMailerDriver implements MailerInterface
{
    use HostTrait;
    protected $status;

    private ContainerInterface $container;

    private PHPMailer $PHPMailer;
    private EmailConf $emailConf;

    public function __construct(EmailConf $emailConf)
    {
        $this->PHPMailer = $this->getPHPMailer($emailConf);
    }

    /**
     * @return mixed
     */
    public function getStatus():bool
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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

    public function setAddress($email):self
    {
        $this->PHPMailer->addAddress($email);
        return $this;
    }

    public function setSubject($subject):self
    {
        $this->PHPMailer->Subject = $subject;
        return $this;
    }

    public function setBody($body):self
    {
        $this->PHPMailer->Body = $body;
        return $this;
    }

    public function setHtml(){
        $this->PHPMailer->isHTML(true);
        return $this;
    }

    public function send():self
    {
        $PHPMailer = $this->PHPMailer;
        $PHPMailer->addReplyTo("1324028467@qq.com");
        $this->setHtml();
        $this->setStatus($PHPMailer->send());
        return $this;
    }


}