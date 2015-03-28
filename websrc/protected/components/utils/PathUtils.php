<?php 
class PathUtils
{
	// return path to folder, creates if doesn't exist
	public static function createFolder($path)
	{
		if(!is_dir($path)){
			mkdir($path);
		}
		return $path;
	}
	
	public static function pathCombine($arg1, $arg2) {
		return $arg1.DIRECTORY_SEPARATOR.$arg2;
	}
}
?>