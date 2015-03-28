<?php 
class EditProfilePopup extends PopupWidget
{
	public function init() {
		$this->linkID = PopupConstants::EditProfilePopupLinkID;
		return parent::init();
	}
	
	protected function renderContent()
	{
		$editProfileForm = new EditProfileForm("update");
		
		/// if it is ajax validation request
		if(Yii::app()->getRequest()->getIsAjaxRequest()) {
			if ($_POST['ajax']===$this->formID) {
				echo CActiveForm::validate($editProfileForm);
				Yii::app()->end();
			}
		}
		
		if(isset($_POST['EditProfileForm'])) {
			$editProfileForm->attributes=$_POST['EditProfileForm'];
			// validate user input and redirect to the previous page if valid
			if($editProfileForm->validate() && $editProfileForm->updateUser()) {
				Yii::app()->user->setFlash('success','Profile successfully updated');
				$this->controller->refresh();
			}
		}

		$user = User::getCurrentUser();
		if (isset($_POST['EditProfileForm'])) {
			// If we got here when the edit profile form was submitted, it means that it wasn't validated
			// Populate form with data user provided
			$editProfileForm->attributes=$_POST['EditProfileForm'];
		} else {
			// Populate with other data
			$editProfileForm->username = $user->Username;
			$editProfileForm->firstname = $user->FirstName;
			$editProfileForm->lastname = $user->LastName;
			$editProfileForm->city = $user->DisplayCity;
			$editProfileForm->state = $user->State;
			$editProfileForm->about = $user->About;
			$editProfileForm->links = $user->Links;
		}
		$this->render('EditProfilePopup',array('editProfileForm'=>$editProfileForm, 'user'=>$user));
	}
}
?>