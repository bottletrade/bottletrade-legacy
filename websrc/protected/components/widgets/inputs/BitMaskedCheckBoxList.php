<?php
class BitMaskedCheckBoxList extends CWidget
{
	public $model;
	public $attribute;
	public $values;
	public $bitMask;
	public $htmlOptions;
	
	private $currentValues;
	private $checkBoxID;
	
	public function init()
	{
		$bitMaskUtil = new BitMaskUtils($this->bitMask);
		
		// find current values
		$currentValues = array();
		foreach ($this->values as $val) {
			if ($bitMaskUtil->hasProperty($val)) {
				$currentValues[] = $val;
			}
		}
		
		// set html options
		if ($this->htmlOptions == null) $this->htmlOptions = array();
		$this->checkBoxID = "A".strval(mt_rand()).strval(mt_rand());
		$this->htmlOptions = array_merge(array('id' => $this->checkBoxID));
		
		
	}
	
	// function to run the widget
	public function run()
	{
		$this->render('BitMaskedCheckBoxList');
	}
}