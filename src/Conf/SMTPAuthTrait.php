<?php

namespace yjHyperfAdminPligin\Email\Conf;

trait SMTPAuthTrait
{
    protected $sMTPAuth = true;

    /**
     * @return bool
     */
    public function getSMTPAuth(): bool
    {
        return $this->sMTPAuth;
    }

    /**
     * @param bool $sMTPAuth
     */
    public function setSMTPAuth(bool $sMTPAuth): void
    {
        $this->sMTPAuth = $sMTPAuth;
    }
}