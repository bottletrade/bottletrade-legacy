<?php
class FormUtils
{
	public static function createDropdownList($vals) {
		$dropdown = array();
		self::addToDropdownList($dropdown, $vals);
		return $dropdown;
	}
	
	public static function addToDropdownList(&$list, $vals) {
		foreach ($vals as $val) {
			$list[$val] = $val;
		}
	}
	
	public static function createDropdownListWithGroup($vals, $group) {
		$dropdown = array();
		self::addToDropdownListWithGroup($dropdown, $vals, $group);
		return $dropdown;
	}
	
	public static function addToDropdownListWithGroup(&$list, $vals, $group) {
		foreach ($vals as $val) {
			$list[$group][$val] = $val;
		}
	}
	
	public static function createEmptyDropdown() {
		return array();
	}
}
?>