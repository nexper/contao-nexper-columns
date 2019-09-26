<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexper\NexperColumns\Element;

/**
 * Clearfix content element
 *
 * @author André Heeke <andre@nexper.de>
 */
class Clearfix extends \ContentElement
{
	/**
	 * @var string Template
	 */
	protected $strTemplate = 'ce_nx_clearfix';

	/**
	 * Parse the template
	 *
	 * @return string Parsed element
	 */
    public function generate()
	{
		if (TL_MODE === 'BE')
        {
            $template = new \BackendTemplate('be_wildcard');

            return $template->parse();
		}

        if (!is_array($this->cssID))
        {
			$this->cssID = array('', '');
		}

        if($this->arrData['cssID'][1] != '')
        {
            $this->arrData['cssID'][1] .= ' w-100';
        }
        else
        {
            $this->arrData['cssID'][1] .= 'w-100';
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
