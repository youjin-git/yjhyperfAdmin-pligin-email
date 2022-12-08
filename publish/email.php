<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'default' => [
        [
            'driver'=> \yjHyperfAdminPligin\Email\Driver\PHPMailerDriver::class,
            'host'=>"smtp.qq.com",
            'username'=>"",
            'password'=>"",
            'port'=>"465",
            'name'=>"your name",
        ],
        [
            'driver'=> \yjHyperfAdminPligin\Email\Driver\PHPMailerDriver::class,
            'host'=>"smtp.qq.com",
            'username'=>"",
            'password'=>"",
            'port'=>"465",
            'name'=>"your name",
        ]
    ],
];
