<?php

namespace yjHyperfAdminPligin\Email;

class Email
{

    private $name = 'default';

    private EmailManager $manager;


    public function __construct(EmailManager $manager)
    {
        $this->manager = $manager;
    }

    public function __call(string $name, array $arguments)
    {
        $manager = $this->manager->setName($this->name)->driver();
        $manager->{$name}(...$arguments);
        return $manager;
    }


    public function name($name='default'):self
    {
        $this->name = $name;
        return $this;
    }


}