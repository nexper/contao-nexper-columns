<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexper\NexperColumns\Element;

/**
 * Column stop content element
 *
 * @author André Heeke <andre@nexper.de>
 */
class ColumnStop extends \ContentElement
{
	/**
	 * @var string Template
	 */
	protected $strTemplate = 'ce_nx_column_stop';
    
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