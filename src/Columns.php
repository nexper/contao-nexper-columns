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
}
