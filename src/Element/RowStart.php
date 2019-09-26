<?php
/*
 * Copyright NEXPER <info@nexper.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nexper\NexperColumns\Element;

/**
 * Row start content element
 *
 * @author André Heeke <andre@nexper.de>
 */
class RowStart extends \ContentElement
{
	/**
	 * @var string Template
	 */
	protected $strTemplate = 'ce_nx_row_start';

    /**
	 * Parse the template
	 *
	 * @return string Parsed element
	 */
    public function generate()
	{
		if (TL_MODE === 'BE') {
			return parent::generate();
		}

        if (!is_array($this->cssID)) {
			$this->cssID = array('', '');
		}

        if($this->arrData['cssID'][1] != '') {
            $this->arrData['cssID'][1] .= ' row';
        } else {
            $this->arrData['cssID'][1] .= 'row';
        }

        if($this->arrData['nx_row_no_padding'] === "1") {
            $this->arrData['cssID'][1] .= ' no-gutters';
        }

        if($this->arrData['nx_row_vertical_center'] === "1") {
            $this->arrData['cssID'][1] .= ' align-items-center';
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
		if (TL_MODE == 'BE') {
			$this->strTemplate = 'be_wildcard';
			$this->Template = new \BackendTemplate($this->strTemplate);
			$this->Template->title = $this->headline;
		}
		else {
			$this->Template = new \FrontendTemplate($this->strTemplate);
			$this->Template->setData($this->arrData);
		}
	}
}
