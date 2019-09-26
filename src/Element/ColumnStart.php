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

        $columnsArr = array(
            'xs' => $this->arrData['nx_columns_xs'], 
            'sm' => $this->arrData['nx_columns_sm'], 
            'md' => $this->arrData['nx_columns_md'], 
            'lg' => $this->arrData['nx_columns_lg'], 
            'xl' => $this->arrData['nx_columns_xl']
        );

        $columnsOffsetArr = array(
            'xs' => $this->arrData['nx_columns_offset_xs'], 
            'sm' => $this->arrData['nx_columns_offset_sm'], 
            'md' => $this->arrData['nx_columns_offset_md'], 
            'lg' => $this->arrData['nx_columns_offset_lg'], 
            'xl' => $this->arrData['nx_columns_offset_xl']
        );

        if (
            $this->arrData['nx_columns_xs'] != '' 
            && $this->arrData['nx_columns_sm'] != '' 
            && $this->arrData['nx_columns_md'] != '' 
            && $this->arrData['nx_columns_lg'] != '' 
            && $this->arrData['nx_columns_xl'] != ''
        ) {
            array_push($classes, 'col');
        } else {
            foreach($columnsArr as $key => $value) {
                if ($value != '') {
                    array_push($classes, 'col-' . $key . '-' . $value);
                }
            }
        }        

        foreach($columnsOffsetArr as $key => $value) {
            if ($value != '') {
                array_push($classes, 'offset-' . $key . '-' . $value);
            }
        }

        if (!is_array($this->cssID)) {
            $this->cssID = array('', '');
        }
        
        if ($this->arrData['cssID'][1] != '') {
            $this->arrData['cssID'][1] .= ' ' . implode(' ', $classes);
        } else {
            $this->arrData['cssID'][1] .= implode(' ', $classes);
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