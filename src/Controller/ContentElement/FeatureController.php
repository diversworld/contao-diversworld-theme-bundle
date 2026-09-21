<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Icon + text feature element (contact rows, social links) rendered via a proper
 * template instead of hand-written HTML content, e.g. the topbar contact/social
 * icons and the "Kontaktdaten" section on the contact page.
 */
#[AsContentElement('dw_feature', category: 'texts', template: 'content_element/dw_feature')]
class FeatureController extends AbstractContentElementController
{
    public function __construct(private readonly InsertTagParser $insertTagParser)
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $headline = StringUtil::deserialize($model->headline);

        $template->set('icon', $model->dwIcon);
        $template->set('headline', \is_array($headline) ? ($headline['value'] ?? '') : $headline);
        $template->set('hl', \is_array($headline) && !empty($headline['unit']) ? $headline['unit'] : 'h3');
        $template->set('text', $model->text ? $this->insertTagParser->replace($model->text) : '');
        $template->set('url', $model->url ? $this->insertTagParser->replace($model->url) : '');
        $template->set('linkTitle', $model->linkTitle);
        $template->set('target', (bool) $model->target);

        return $template->getResponse();
    }
}
