<?php

namespace yjHyperfAdminPligin\Email\Conf;

trait NameTrait
{
    protected string $name = 'your name';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}