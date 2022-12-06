<?php

namespace yjHyperfAdminPligin\Email;

class Email
{
    private EmailManager $manager;

    public function __construct(EmailManager $manager)
    {
        $this->manager = $manager->getNewDriver();
    }

    public function __call(string $name, array $arguments)
    {
         $this->manager->{$name}(...$arguments);
         return $this;
    }

}