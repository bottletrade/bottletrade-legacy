<?php
/**
 * XLoginPortlet class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

Yii::import('application.extensions.portlet.XPortlet');
Yii::import('application.extensions.login.XLoginForm');

/**
 * XLoginPortlet is a portlet that provides user login functionality.
 *
 * XLoginPortlet requires users to provide username and password.
 * It then uses UserIdentity (specified via {@link identityClass}) property)
 * to perform the actual authentication. If successful, it will
 * login the user and reload the current page.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: $
 */
class XLoginPortlet extends XPortlet
{
	/**
	 * @var string the portlet title. Defaults to 'Login'.
	 */
	public $title=null;
	/**
	 * @var boolean whether to enable remember login feature. Defaults to false.
	 * If you set this to true, please make sure you also set CWebUser.allowAutoLogin
	 * to be true in the application configuration.
	 */
	public $enableRememberMe=true;
	/**
	 * @var string user identity class. Defaults to 'application.components.UserIdentity'.
	 */
	public $identityClass='application.components.UserIdentity';

	/**
	 * Renders the body content in the portlet.
	 * This is required by XPortlet.
	 */
	protected function renderContent()
	{
		$loginForm=new LoginForm;
		if(isset($_POST['LoginForm']))
		{
			$loginForm->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($loginForm->validate() && $loginForm->login())
            {
            	$this->controller->redirect(UrlUtils::generateUrl(UrlUtils::ProfileUri));
            }
		}
		$this->render('loginPortlet',array('user'=>$loginForm));
	}
}
