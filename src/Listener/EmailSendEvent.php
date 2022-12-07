<?php

namespace yjHyperfAdminPligin\Email\Contracts;

class EmailSendEvent
{
    private string $email;
    private array $data;
    private bool $status;

    public function __construct(bool $status,string $email, array $data)
    {
        $this->email = $email;
        $this->data = $data;
        $this->status = $status;
    }

}