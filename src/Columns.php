<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexper\NexperColumns;

/**
 * Nexper Columns DCA (tl_content and tl_module)
 *
 * Provide miscellaneous methods that are used by the data configuration arrays.
 *
 * @author André Heeke <andre@nexper.de>
 */
class Columns
{
    public function getContentElementHook($row, $content) 
    {
        return $content;
    }
    
    /**
	 * generatePage hook
	 *
	 * @param  \PageModel   $page
	 * @param  \LayoutModel $layout
	 * @param  \PageRegular $pageRegular
	 * @return void
	 */
	public function generatePageHook(\PageModel $page, \LayoutModel $layout, \PageRegular $pageRegular)
	{
        $assetsDir = 'bundles/nexpercolumns/frontend/';
        
        if(!isset($GLOBALS['TL_CONFIG']['nxColumnsFramework'])) {
            $GLOBALS['TL_CONFIG']['nxColumnsFramework'] = 'bootstrap-3';
        }
        
        if($layout->nx_columns_load_reset_css) {
			$GLOBALS['TL_CSS'][] = $assetsDir . $GLOBALS['TL_CONFIG']['nxColumnsFramework'] . '/css/reset.css||static';
        }
        
		if ($layout->nx_columns_load_css) {            
			$GLOBALS['TL_CSS'][] = $assetsDir . $GLOBALS['TL_CONFIG']['nxColumnsFramework'] . '/css/columns.css||static';
		}
	}
    
    /**
	 * tl_content DCA onload callback
	 *
	 * Delete unused select options
	 *
	 * @param  \DataContainer $dc Data container
	 * @return void
	 */
    public function onloadCallback(\DataContainer $dc)
    {
        $selectionObj = \Database::getInstance()
            ->prepare('SELECT type,nx_columns_selection FROM tl_content WHERE id = ? AND type = ?')
            ->execute($dc->id, 'nx_column_start');
        $selectionSizes = array('xs', 'sm', 'md', 'lg', 'xl');
        
        if($selectionObj->type === 'nx_column_start' && $selectionObj->nx_columns_selection != '') 
        {
            $selectionArr = unserialize($selectionObj->nx_columns_selection);

            foreach($selectionSizes as $selectionItem) 
            {
                if(!in_array($selectionItem, $selectionArr)) 
                { 
                    unset($GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_' . $selectionItem]);
                    unset($GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_' . $selectionItem]);
                }
            }
        } 
        else 
        {
            foreach($selectionSizes as $selectionItem) 
            {
                unset($GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_' . $selectionItem]);
                unset($GLOBALS['TL_DCA']['tl_content']['fields']['nx_columns_offset_' . $selectionItem]);
            }
        }
    }
    
    /**
	 * tl_content DCA onsubmit callback
	 *
	 * Creates a stop element after a start element was created
	 *
	 * @param  \DataContainer $dc Data container
	 * @return void
	 */
	public function onsubmitCallback($dc)
	{
		$activeRecord = $dc->activeRecord;
		if (!$activeRecord) {
			return;
		}
		if ($activeRecord->type === 'nx_container_start' || $activeRecord->type === 'nx_row_start' || $activeRecord->type === 'nx_column_start') {
			// Find the next columns or column element
			$nextElement = \Database::getInstance()
				->prepare('
					SELECT type
					FROM tl_content
					WHERE pid = ?
						AND (ptable = ? OR ptable = ?)
						AND type IN (\'nx_column_start\', \'nx_column_stop\', \'nx_row_start\', \'nx_row_stop\', \'nx_container_start\', \'nx_container_stop\')
						AND sorting > ?
					ORDER BY sorting ASC
					LIMIT 1
				')
				->execute(
					$activeRecord->pid,
					$activeRecord->ptable ?: 'tl_article',
					$activeRecord->ptable === 'tl_article' ? '' : $activeRecord->ptable,
					$activeRecord->sorting
				);
			// Check if a stop element should be created
			if (
				!$nextElement->type
                || ($activeRecord->type === 'nx_container_start' && $nextElement->type === 'nx_row_stop')
				|| ($activeRecord->type === 'nx_row_start' && $nextElement->type === 'nx_column_stop')
				|| ($activeRecord->type === 'nx_column_start' && (
					$nextElement->type === 'nx_column_start' || $nextElement->type === 'nx_row_stop'
				))
                || ($activeRecord->type === 'nx_row_start' && (
					$nextElement->type === 'nx_row_start' || $nextElement->type === 'nx_container_stop'
				))
			) {
				\Database::getInstance()
					->prepare('INSERT INTO tl_content %s')
					->set(array(
						'pid' => $activeRecord->pid,
						'ptable' => $activeRecord->ptable ?: 'tl_article',
						'type' => substr($activeRecord->type, 0, -5) . 'stop',
						'sorting' => $activeRecord->sorting + 1,
						'tstamp' => time(),
					))
					->execute();
			}
		}
	}
    
    public function getBackendClass()
    {
        if ($GLOBALS['TL_CONFIG']['nxColumnsFramework'] === 'bootstrap-3') {
            return 'nx_w25';
        } elseif ($GLOBALS['TL_CONFIG']['nxColumnsFramework'] === 'bootstrap-4') {
            return 'nx_w20';
        }
    }
}