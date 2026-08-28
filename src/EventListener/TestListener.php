<?php

namespace Diversworld\ContaoDiversworldThemeBundle\EventListener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: 'kernel.response')]
class TestListener
{
    public function __invoke(ResponseEvent $event): void
    {
        file_put_contents(
            '/tmp/diversworld-test.log',
            "works\n",
            FILE_APPEND
        );
    }
}