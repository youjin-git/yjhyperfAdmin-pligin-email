<?php

namespace yjHyperfAdminPligin\Email;

use Hyperf\Contract\ConfigInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use yjHyperfAdminPligin\Email\Conf\HostTrait;
use yjHyperfAdminPligin\Email\Conf\NameTrait;
use yjHyperfAdminPligin\Email\Conf\PasswordTrait;
use yjHyperfAdminPligin\Email\Conf\PortTrait;
use yjHyperfAdminPligin\Email\Conf\SMTPAuthTrait;
use yjHyperfAdminPligin\Email\Conf\UsernameConf;
use yjHyperfAdminPligin\Email\Conf\UsernameTrait;
use yjHyperfAdminPligin\Email\Driver\PHPMailerDriver;

class EmailConf
{
    use HostTrait;
    use SMTPAuthTrait;
    use UsernameTrait;
    use PasswordTrait;
    use PortTrait;
    use NameTrait;

    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->initConfig();
    }

    public function setConfig(PHPMailer $PHPMailer){
        $PHPMailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $PHPMailer->isSMTP();                                            //Send using SMTP
        $PHPMailer->Host = $this->getHost();                     //Set the SMTP server to send through
        $PHPMailer->SMTPAuth = $this->getSMTPAuth();                                 //Enable SMTP authentication
        $PHPMailer->Username = $this->getUsername();               //SMTP username
        $PHPMailer->Password = $this->getPassword();                             //SMTP password
        $PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $PHPMailer->Port = $this->getPort(); //SMTP
        $PHPMailer->setFrom($this->getUsername(), $this->getName());
    }

    protected function initConfig($name = 'default'){
        $config = $this->config->get("email.{$name}");
        //随机取一个配置
        if(count($config) != count($config, 1)){
            $config = $config[array_rand($config)];
        }

        $this->setHost($config['host']);
        $this->setUsername($config['username']);
        $this->setPassword($config['password']);
        $this->setPort($config['port']);
        $this->setName($config['name']);
    }

}