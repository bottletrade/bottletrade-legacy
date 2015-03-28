<?php 
//create a link
echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));
echo CHtml::ajaxLink("Update Html", array('site/getFriendList'),
		 array('update'=>'#FriendListContainer', 
		 	   'complete'=>"function() { $('#FriendListLoading').hide(); }",
				'beforeSend'=>"function() { $('#FriendListLoading').show(); }"), 
		  array('id'=>'AjaxFriendListTrigger', 'class'=>'hidden'));

//put fancybox on page
$contentSelector = '#'.$this->popupID;
$linkSelector = '#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>
<script type="text/javascript">
$(document).ready(function() {
	$('<?php echo $linkSelector; ?>').click(function() {
		$('#AjaxFriendListTrigger').click();
    });
	$('#AjaxFriendListTrigger').click();
});
</script>

<div id="<?php echo $this->popupID; ?>" class="popup mfp-hide friend">
	<img src="<?php echo UrlUtils::generateImageUrl("friends/title_icon.png"); ?>" width="180" height="140"/><br>
	<div id="FriendListLoading">
		<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="30px" height="30px"/>
	</div>
	<div id="FriendListContainer">
	</div><br>
	<div style="width: 500px; height: 35px; margin: 5px auto; text-align: center;">
	<button class='medium' onclick='$.magnificPopup.close(); return false;'>CLOSE</button>
	</div>
</div>
