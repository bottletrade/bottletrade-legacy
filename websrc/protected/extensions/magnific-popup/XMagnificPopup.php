<?php

class XMagnificPopup extends CWidget
{
	// @ string the id of the widget, since version 1.6
	public $id;
	// @ string the taget element on DOM
	public $linkSelector;
	public $contentSelector;
	
	// function to init the widget
	public function init()
	{
		// if not informed will generate Yii defaut generated id, since version 1.6
		if(!isset($this->id))
			$this->id=$this->getId();
		// publish the required assets
		$this->publishAssets();
	}
	
	// function to run the widget
    public function run()
    {
		Yii::app()->clientScript->registerScript($this->getId(), "
			$(window).load(function() {
				$('$this->linkSelector').magnificPopup({
			        	items: [{
			            	src: $('$this->contentSelector'),
					        type: 'inline'
			        	}],
			        	closeOnBgClick: false
			    });
				$('$this->linkSelector').click(function() {
					setTimeout(function(){
						$('$this->linkSelector').magnificPopup('open');
	    			}, 500);
				});
			});
		");
	}
	
	// function to publish and register assets on page 
	public function publishAssets()
	{
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);
		if(is_dir($assets)){
			Yii::app()->clientScript->registerCssFile($baseUrl . '/magnific-popup.css');
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl . '/jquery.magnific-popup.js', CClientScript::POS_HEAD);
		} else {
			throw new Exception('XMagnificPopup - Error: Couldn\'t find assets to publish.');
		}
	}
}