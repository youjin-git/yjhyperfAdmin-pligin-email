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
namespace yjHyperfAdminPligin\Email;

use Hyperf\Cache\Listener\DeleteListener;
use Psr\SimpleCache\CacheInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'id' => 'email',
                    'description' => 'The config for email.',
                    'source' => __DIR__ . '/../publish/email.php',
                    'destination' => BASE_PATH . '/config/autoload/email.php',
                ],
            ],
        ];
    }
}
