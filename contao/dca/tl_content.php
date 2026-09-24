<?php

declare(strict_types=1);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_content']['palettes']['dw_feature'] = '
    {type_legend},type,dwIcon;
    {headline_legend:hide},headline;
    {text_legend},text;
    {link_legend},url,linkTitle,target;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID,space
';

$GLOBALS['TL_DCA']['tl_content']['fields']['dwIcon'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => false, 'maxlength' => 64, 'tl_class' => 'w50'],
    'sql' => ['type' => 'string', 'length' => 64, 'default' => ''],
];

// Allow the core "text" content element to optionally show an icon (Font Awesome
// class) above the headline, so icon+text combinations no longer require the
// custom dw_feature element.
PaletteManipulator::create()
    ->addLegend('icon_legend', 'text_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField('dwIcon', 'icon_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('text', 'tl_content')
;
