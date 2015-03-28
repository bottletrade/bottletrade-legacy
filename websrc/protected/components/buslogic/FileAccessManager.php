<?php

class FileAccessManager
{
	private $model;
	public function __construct($model)
	{
		$this->model = $model;
	}
	
	public function hasAccess()
	{
		if (ModelTypeUtils::isUser($this->model)) {
			if ($this->model->ID == Yii::app()->user->ID) {
				// requesting access to same user's data
				return true;
			} else {
				// requesting access to another user's data
				return $this->model->IsPrivate == 0;
			}
		} else if (ModelTypeUtils::isBottle($this->model)) {
			if ($this->model->UserID == Yii::app()->user->ID) {
				// requesting access to same user's data
				return true;
			} else {
				// requesting access to another user's data
				return $this->model->IsPrivate == 0;
			}
		}
		return false;
	}
}