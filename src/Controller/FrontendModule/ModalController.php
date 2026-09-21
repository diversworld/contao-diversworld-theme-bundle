<?php

declare(strict_types=1);

namespace Diversworld\ContaoDiversworldThemeBundle\Controller\FrontendModule;

use Contao\Controller;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Native-<dialog>-based replacement for the "Theme Helper" modal module
 * (pdir/contao-theme-helper-bundle), which is not available for Contao 6.
 */
#[AsFrontendModule('dw_modal', category: 'miscellaneous', template: 'frontend_module/dw_modal')]
class ModalController extends AbstractFrontendModuleController
{
    public function __construct(private readonly InsertTagParser $insertTagParser)
    {
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $headline = StringUtil::deserialize($model->headline);

        $template->set('headline', \is_array($headline) ? ($headline['value'] ?? '') : $headline);
        $template->set('hl', \is_array($headline) && !empty($headline['unit']) ? $headline['unit'] : 'h2');
        $template->set('linkText', $model->dwModalLinkText);
        $template->set('linkClass', $model->dwModalLinkClass);
        $template->set('size', $model->dwModalSize ?: 'default');
        $template->set('dialogId', 'dw-modal-'.$model->id);
        $template->set('text', $model->dwModalText ? $this->insertTagParser->replace($model->dwModalText) : '');
        $template->set('form', $model->form ? Controller::getFrontendModule($model->form) : null);

        return $template->getResponse();
    }
}
