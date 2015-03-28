<?php 
class ExceptionUtils
{
	public static function createInvalidOperationException() {
		return new CHttpException(500,"Requested action cannot be performed, please try again");
	}
	
	public static function createUnauthorizedException() {
		return new CHttpException(500,"You are not authorized to perform the requested action");
	}
	
	public static function createVarException($var)
	{
		return new Exception(CVarDumper::DumpAsString($var));
	}
	
	public static function logException($e) {
		throw new Exception($e);
	}
}
?>