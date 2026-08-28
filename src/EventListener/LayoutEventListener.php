<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\EventListener;

use Contao\CoreBundle\Event\LayoutEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class LayoutEventListener
{
    

    public function __invoke(LayoutEvent $event): void
    {
        file_put_contents(
            '/tmp/dw_listener.log',
            "listener reached\n",
            FILE_APPEND
        );

        $GLOBALS['TL_CSS'][] =
            'bundles/contaodiversworldtheme/css/diversworld.css|static';
    }
}
