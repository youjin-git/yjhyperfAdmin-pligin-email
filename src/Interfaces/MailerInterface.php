<?php
namespace yjHyperfAdminPligin\Email\Interfaces;

interface MailerInterface
{

    public function setAddress(string $address):self;

    public function setSubject(string $subject):self;

    public function setBody(string $body):self;

    public function send():self;

    public function getStatus():bool;

    public function getErrorMessage():string;

    public function getEmail():string;
}