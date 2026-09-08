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
        $GLOBALS['TL_CSS'][] = 'bundles/contaodiversworldtheme/css/bootstrap.css|static';
        $GLOBALS['TL_CSS'][] = 'bundles/contaodiversworldtheme/css/diversworld.css|static';
        $GLOBALS['TL_CSS'][] = 'bundles/contaodiversworldtheme/css/fontawesome.css|static';
        $GLOBALS['TL_CSS'][] = 'files/diversworld/css/custom.css|static';

        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaodiversworldtheme/js/navigation.js|static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaodiversworldtheme/js/mobile-menu.js|static';
    }
}
