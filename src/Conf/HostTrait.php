<?php

namespace yjHyperfAdminPligin\Email\Conf;

trait HostTrait
{
    private $host = 'smtp.qq.com';

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }
}