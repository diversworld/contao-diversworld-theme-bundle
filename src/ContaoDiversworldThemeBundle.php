<?php

namespace Diversworld\ContaoDiversworldThemeBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ContaoDiversworldThemeBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
