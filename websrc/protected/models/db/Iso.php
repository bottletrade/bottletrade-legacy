<?php

class Iso extends BaseIso
{
	public static function isOwnedByCurrentUser($iso) {
        return $iso->UserID == Yii::app()->user->ID;
    }
}