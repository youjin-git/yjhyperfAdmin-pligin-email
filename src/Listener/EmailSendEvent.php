<?php

namespace yjHyperfAdminPligin\Email\Contracts;

class EmailSendEvent
{
    private Array $email;
    private array $data;
    private bool $status;

    public function __construct(bool $status,Array $email, array $data)
    {
        $this->email = $email;
        $this->data = $data;
        $this->status = $status;
    }

}