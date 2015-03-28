<?php 
class DatabaseUtils
{
	public static function startTransaction(&$isNew) {
		$trans = Yii::app()->db->getCurrentTransaction();
		if ($trans != null && $trans->getActive()) {
			$isNew = false;
			return $trans;
		} else {
			$isNew = true;
			return Yii::app()->db->beginTransaction();
		}
	}
}
?>