<?php 
class AgeVerificationDisplay extends CWidget
{
	public static function createCookie() {
		Yii::app()->request->cookies['ageVerified'] = new CHttpCookie('ageVerified', true);
	}
	
	public function run()
	{
		// collect user input data
		if(isset($_POST['AgeVerificationResponse'])) {
			$response = $_POST['AgeVerificationResponse'];
			if ($response == "YES") {
				self::createCookie();
				$this->controller->refresh();
			}
		}
		$this->render('AgeVerificationDisplay');
	}
}
?>