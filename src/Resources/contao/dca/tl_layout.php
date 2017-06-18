<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] .= ';{nx_columns_legend},nx_columns_load_reset_css,nx_columns_load_css';

$GLOBALS['TL_DCA']['tl_layout']['fields']['nx_columns_load_reset_css'] = array(
	'inputType' => 'checkbox',
	'label' => &$GLOBALS['TL_LANG']['tl_layout']['nx_columns_load_reset_css'],
    'eval' => array('tl_class' => 'w50'),
	'sql' => "char(1) NOT NULL default '0'",
);
$GLOBALS['TL_DCA']['tl_layout']['fields']['nx_columns_load_css'] = array(
	'inputType' => 'checkbox',
	'label' => &$GLOBALS['TL_LANG']['tl_layout']['nx_columns_load_css'],
    'eval' => array('tl_class' =>'w50'),
	'sql' => "char(1) NOT NULL default '1'",
);