<?php

declare(strict_types=1);

$GLOBALS['TL_DCA']['tl_module']['palettes']['dw_modal'] = '
    {title_legend},name,headline,type;
    {config_legend},dwModalLinkText,dwModalLinkClass,dwModalSize;
    {source_legend},dwModalText,form;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID,space
';

$GLOBALS['TL_DCA']['tl_module']['fields']['dwModalLinkText'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['dwModalLinkClass'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['dwModalSize'] = [
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['default', 'narrow', 'wide'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['dwModalSize_options'],
    'eval' => ['tl_class' => 'w50', 'includeBlankOption' => false],
    'sql' => ['type' => 'string', 'length' => 32, 'default' => 'default'],
];

$GLOBALS['TL_DCA']['tl_module']['fields']['dwModalText'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'textarea',
    'eval' => ['mandatory' => false, 'rte' => 'tinyMCE', 'tl_class' => 'clr'],
    'sql' => ['type' => 'text', 'notnull' => false],
];
