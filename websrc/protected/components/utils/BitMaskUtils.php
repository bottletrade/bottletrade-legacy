<?php 
class BitMaskUtils
{
	private $value;
	
	public function __construct($value) {
		$this->value = $value;
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public function isProperty($property) {
		return $this->value == $property;
	}
	
	public function hasProperty($property) {
		return ($this->value & $property) == $property;
	}
	
	public function addProperty($property) {
		$this->value = $this->value | $property;
	}
	
	public function removeProperty($property) {
		$this->value = $this->value & ~$property;
	}
	
	public function setProperty($property) {
		$this->value = $property;
	}
}
?>