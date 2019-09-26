<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (TL_MODE === 'BE') {
	$GLOBALS['TL_CSS'][] = 'bundles/nexpercolumns/backend/css/nx_columns.css';
}

// HOOKS
$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('Nexper\\NexperColumns\\Columns', 'onloadCallback');
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('Nexper\\NexperColumns\\Columns', 'onsubmitCallback');

// nx_container_start
$GLOBALS['TL_DCA']['tl_content']['palettes']['nx_container_start'] = '{type_legend},type,headline;{protected_legend:hide},protected;{expert_legend},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

// nx_row_start
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'nx_row_equal_height';
$GLOBALS['TL_DCA']['tl_content']['palettes']['nx_row_start'] = '{type_legend},type;{nx_row_legend},nx_row_no_padding,nx_row_vertical_center;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_row_no_padding'] = array(
    'inputType' => 'checkbox',
    'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_row_no_padding'],
    'eval' => array('tl_class' => 'w50 clr'),
    'sql' => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_row_vertical_center'] = array(
    'inputType' => 'checkbox',
    'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_row_vertical_center'],
    'eval' => array('tl_class' => 'w50'),
    'default' => 0,
    'sql' => "char(1) NOT NULL default ''",
);

// nx_column_start
$GLOBALS['TL_DCA']['tl_content']['palettes']['nx_column_start'] = '{type_legend},type,headline;{nx_columns_legend},nx_columns_xs,nx_columns_sm,nx_columns_md,nx_columns_lg,nx_columns_xl;{nx_columns_offset_legend},nx_columns_offset_xs,nx_columns_offset_sm,nx_columns_offset_md,nx_columns_offset_lg,nx_columns_offset_xl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_xs'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_xs'],
    'default' => 12,
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
	'eval' => array('tl_class' => 'nx_w20', 'includeBlankOption' => true),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_sm'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_sm'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'default' => 12,
	'eval' => array('tl_class' => 'nx_w20', 'includeBlankOption' => true),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_md'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_md'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'default' => 12,
	'eval' => array('tl_class' => 'nx_w20', 'includeBlankOption' => true),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_lg'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_lg'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'default' => 12,
	'eval' => array('tl_class' => 'nx_w20', 'includeBlankOption' => true),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_xl'] = array(
    'inputType' => 'select',
    'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_xl'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'default' => 12,
    'eval' => array('tl_class' => 'nx_w20', 'includeBlankOption' => true),
    'sql' => "char(2) NOT NULL default ''",
);

// OFFSET
$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_xs'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_offset_xs'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
	'eval' => array('includeBlankOption' => true, 'tl_class' => 'nx_w20'),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_sm'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_offset_sm'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'eval' => array('includeBlankOption' => true, 'tl_class' => 'nx_w20'),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_md'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_offset_md'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'eval' => array('includeBlankOption' => true, 'tl_class' => 'nx_w20'),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_lg'] = array(
	'inputType' => 'select',
	'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_offset_lg'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'eval' => array('includeBlankOption' => true, 'tl_class' => 'nx_w20'),
    'sql' => "char(2) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_xl'] = array(
    'inputType' => 'select',
    'label' => &$GLOBALS['TL_LANG']['tl_content']['nx_columns_offset_xl'],
    'options' => $GLOBALS['TL_LANG']['tl_content']['nx_columns_sizes'][$GLOBALS['TL_CONFIG']['nxColumnsFramework']],
    'eval' => array('includeBlankOption' => true, 'tl_class' => 'nx_w20'),
    'sql' => "char(2) NOT NULL default ''",
);

// nx_clearfix
$GLOBALS['TL_DCA']['tl_content']['palettes']['nx_clearfix'] = '{type_legend},type;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
