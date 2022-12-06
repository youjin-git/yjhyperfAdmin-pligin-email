<?php

namespace yjHyperfAdminPligin\Email\Conf;

trait PasswordTrait
{
    protected string $password;

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}