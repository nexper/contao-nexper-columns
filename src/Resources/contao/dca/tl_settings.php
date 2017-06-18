<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{nx_columns_settings:hide},nxColumnsFramework;';

array_insert($GLOBALS['TL_DCA']['tl_settings']['fields'], 0, array( 
    'nxColumnsFramework' => array(
        'inputType' => 'select',
        'label' => &$GLOBALS['TL_LANG']['tl_settings']['nx_columns_framework'],
        'options' => array('bootstrap-3' => 'Bootstrap 3', 'bootstrap-4' => 'Bootstrap 4'),
        'eval' => array('tl_class' => 'w50'),
    ),
));