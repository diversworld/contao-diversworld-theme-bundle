<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Diversworld\ContaoDiversworldThemeBundle\ContaoDiversworldThemeBundle;
use ContaoThemesNet\ThemeComponentsBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoDiversworldThemeBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ThemeComponentsBundle::class,
                ]),
        ];
    }
}
