<?php

class SiteTest extends WebTestCase
{
	public function testIndex()
	{
		$this->open('');
		$this->assertTextPresent('BottleTrade');
	}

	public function testNewUser()
	{
		$this->open('site/login');

		$this->assertElementPresent('name=NewUserForm[firstname]');
		$this->type('name=NewUserForm[firstname]','demo');
		$this->assertElementPresent('name=NewUserForm[lastname]');
		$this->type('name=NewUserForm[lastname]','demo');
		$this->assertElementPresent('name=NewUserForm[email]');
		$this->type('name=NewUserForm[email]','demo@demo.com');
		$this->assertElementPresent('name=NewUserForm[username]');
		$this->type('name=NewUserForm[username]','demo');
		$this->assertElementPresent('name=NewUserForm[password]');
		$this->type('name=NewUserForm[password]','demo');
		$this->assertElementPresent('name=NewUserForm[confirm_password]');
		$this->type('name=NewUserForm[confirm_password]','demo');
		$this->assertElementPresent('name=NewUserForm[birthday]');
		$this->type('name=NewUserForm[birthday]','1/10/1999');
		$this->clickAndWait("//input[@value='submit']");
		$this->assertTextPresent('PROFILE');
		$this->assertTextPresent('LOGOUT');
		
		$this->open('site/deleteUser');
		
		$this->assertTextPresent('HOME');
		$this->assertTextPresent('LOGIN');
	}
	
	public function testEditProfile()
	{/*
		$this->createTestUser();
		$this->open('profile');
		
		$this->click('link=Edit Profile');

		$this->assertElementPresent('name=NewUserForm[firstname]');
		$this->type('name=NewUserForm[firstname]','bobby');
		$this->clickAndWait("//input[@value='submit']");*/
	}

	public function testLoginLogout()
	{
		$this->createTestUser();
		$this->logout();
		
		$this->open('');
		// test login process, including validation
		$this->clickAndWait('link=LOGIN');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','demo');
		$this->click("//input[@value='Login']");
		$this->waitForTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','demo');
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextNotPresent('Password cannot be blank.');
		$this->assertTextPresent('LOGOUT');

		// test logout process
		$this->assertTextNotPresent('LOGIN');
		$this->clickAndWait('link=LOGOUT');
		$this->assertTextPresent('LOGIN');
		
		$this->deleteTestUser();
	}
}
