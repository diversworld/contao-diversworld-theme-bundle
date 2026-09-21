<?php

declare(strict_types=1);

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
    'eval' => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'w50'],
    'sql' => ['type' => 'string', 'length' => 64, 'default' => ''],
];
