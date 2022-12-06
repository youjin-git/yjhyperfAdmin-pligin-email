<?php

namespace yjHyperfAdminPligin\Email\Conf;

trait PortTrait
{
    protected string $port = '465';

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort(string $port): void
    {
        $this->port = $port;
    }
}