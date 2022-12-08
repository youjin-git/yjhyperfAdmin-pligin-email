<?php

namespace yjHyperfAdminPligin\Email;

use Hyperf\Contract\ConfigInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use yjHyperfAdminPligin\Email\Conf\DriverNameTrait;
use yjHyperfAdminPligin\Email\Conf\HostTrait;
use yjHyperfAdminPligin\Email\Conf\NameTrait;
use yjHyperfAdminPligin\Email\Conf\PasswordTrait;
use yjHyperfAdminPligin\Email\Conf\PortTrait;
use yjHyperfAdminPligin\Email\Conf\SMTPAuthTrait;
use yjHyperfAdminPligin\Email\Conf\UsernameConf;
use yjHyperfAdminPligin\Email\Conf\UsernameTrait;
use yjHyperfAdminPligin\Email\Driver\PHPMailerDriver;
use yjHyperfAdminPligin\Email\Interfaces\MailerInterface;

class EmailConf
{
    use HostTrait;
    use SMTPAuthTrait;
    use UsernameTrait;
    use PasswordTrait;
    use PortTrait;
    use NameTrait;
    use DriverNameTrait;

    /**
     * @var ConfigInterface
     */
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getDriver(?string $name = null):PHPMailerDriver
    {
        $this->initConfig($name);
        $driverName = $this->getDriverName();
        /** @var MailerInterface $driver */
        $driver =new $driverName();
        $this->setConfig($driver);
        return $driver;
    }

    public function setConfig(MailerInterface $mailer){
        $PHPMailer = $mailer->getMailer();
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

    protected function initConfig(string|null $name){
        $emailConfigs = $this->config->get("email");
        $config = $emailConfigs[$name??'default'];
        if(is_string($config)){
            $config = $emailConfigs[$config];
        }
        //随机取一个配置
        if(count($config) != count($config, 1)){
            $config = $config[array_rand($config)];
        }
        $this->setHost($config['host']);
        $this->setUsername($config['username']);
        $this->setPassword($config['password']);
        $this->setPort($config['port']);
        $this->setName($config['name']);
        $this->setDriverName($config['driver']??null);
    }

}