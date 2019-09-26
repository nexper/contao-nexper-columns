<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// HOOKS
$GLOBALS['TL_HOOKS']['getContentElement'][] = array('Nexper\\NexperColumns\\Columns', 'getContentElementHook');

// Content elements
$GLOBALS['TL_CTE']['nx_columns']['nx_container_start'] = 'Nexper\\NexperColumns\\Element\\ContainerStart';
$GLOBALS['TL_CTE']['nx_columns']['nx_container_stop'] = 'Nexper\\NexperColumns\\Element\\ContainerStop';
$GLOBALS['TL_CTE']['nx_columns']['nx_row_start'] = 'Nexper\\NexperColumns\\Element\\RowStart';
$GLOBALS['TL_CTE']['nx_columns']['nx_row_stop'] = 'Nexper\\NexperColumns\\Element\\RowStop';
$GLOBALS['TL_CTE']['nx_columns']['nx_column_start'] = 'Nexper\\NexperColumns\\Element\\ColumnStart';
$GLOBALS['TL_CTE']['nx_columns']['nx_column_stop'] = 'Nexper\\NexperColumns\\Element\\ColumnStop';
$GLOBALS['TL_CTE']['nx_columns']['nx_clearfix'] = 'Nexper\\NexperColumns\\Element\\Clearfix';

// Wrappers
$GLOBALS['TL_WRAPPERS']['start'][] = 'nx_container_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'nx_container_stop';
$GLOBALS['TL_WRAPPERS']['start'][] = 'nx_row_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'nx_row_stop';
$GLOBALS['TL_WRAPPERS']['start'][] = 'nx_column_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'nx_column_stop';
