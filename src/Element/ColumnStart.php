<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexper\NexperColumns\Element;

/**
 * Column start content element
 *
 * @author André Heeke <andre@nexper.de>
 */
class ColumnStart extends \ContentElement
{
	/**
	 * @var string Template
	 */
	protected $strTemplate = 'ce_nx_column_start';

	/**
	 * Parse the template
	 *
	 * @return string Parsed element
	 */
    public function generate()
	{
		if (TL_MODE === 'BE') {
            $template = new \BackendTemplate('be_wildcard');
			$template->title = $this->headline;
			$template->id = $this->id;
            
            return $template->parse();
		}
        
        $classes = array();
        $parentKey = ($this->arrData['ptable'] ?: 'tl_article') . '__' . $this->arrData['pid'];
        
        if($this->arrData['nx_columns_selection'] != '') {
            $selectionArr = unserialize($this->arrData['nx_columns_selection']);
        
            foreach($selectionArr as $size) {
                $columnLength = $this->arrData['nx_columns_' . $size];            
                $offsetLength = $this->arrData['nx_columns_offset_' . $size];            
                
                array_push($classes, 'col-' . $size . '-' . $columnLength);
                
                if($offsetLength != '') {
                    array_push($classes, 'col-' . $size . '-offset-' . $offsetLength);
                }
            }

            if (!is_array($this->cssID)) {
                $this->cssID = array('', '');
            }
            
            if($this->arrData['cssID'][1] != '') {
                $this->arrData['cssID'][1] .= ' ' . implode(' ', $classes);
            } else {
                $this->arrData['cssID'][1] .= implode(' ', $classes);
            }
            
        }
        
		return parent::generate();
    }

	/**
	 * Compile the content element
	 *
	 * @return void
	 */
	public function compile()
	{
        $this->Template = new \FrontendTemplate($this->strTemplate);
        $this->Template->setData($this->arrData);
	}
}