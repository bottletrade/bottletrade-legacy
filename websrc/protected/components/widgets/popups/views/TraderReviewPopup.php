<?php 		
//create a link
echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));

//put fancybox on page
$contentSelector = 'div#'.$this->popupID;
$linkSelector = 'a#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>
<div id="<?php echo $this->popupID; ?>" class="popup mfp-hide">
	<?php
			$traderReviewFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>$this->formID,
                                                    'enableAjaxValidation'=>true
                                                    )); ?>
	<?php echo $traderReviewFormWidget->hiddenField($traderReviewForm,'tradeId'); ?>
	<?php echo $traderReviewFormWidget->hiddenField($traderReviewForm,'userTo'); ?>
	<div style="text-align: center;">
		<img src="<?php echo UrlUtils::generateImageUrl("trader_review/title_icon.png"); ?>" width="180" height="140"/>
		<br />
		<span class="black-large bold">Trader Review for <?php echo Trade::getOtherUser($this->trade)->Username; ?></span>
	</div>
	<span class="black">
	<table class="trader-review">
	<tr>
		<td class="text_field_prompt"><?php echo $traderReviewFormWidget->label($traderReviewForm,'rating'); ?></td>
		<td><?php echo $traderReviewFormWidget->dropDownList($traderReviewForm, 'rating', FormUtils::createDropdownList(array('Choose rating (5 best, 1 worst)','5','4','3','2','1'))); ?>
		<?php echo $traderReviewFormWidget->error($traderReviewForm,'rating'); ?></td>
	</tr>
	<tr>
		<td class="text_field_prompt"><?php echo $traderReviewFormWidget->label($traderReviewForm,'message'); ?></td>
		<td valign="top"><?php echo $traderReviewFormWidget->textArea($traderReviewForm,'message'); ?>
		<?php echo $traderReviewFormWidget->error($traderReviewForm,'message'); ?></td>
	</tr>
	<tr>
		<td colspan=2" align="center">
			<span class="black">(Reviews will not be editable by reviewee.)</span>
			<br/><br />
			<?php echo CHtml::submitButton('SUBMIT', array('class'=> 'medium')); ?>
			<?php echo CHtml::button('CANCEL', array('class'=> 'medium','onclick'=>'$.magnificPopup.close(); return false;')); ?></td>
	</tr>
	</table>
	</span>
	<?php $this->endWidget(); ?>
</div>


<?php 
	Yii::app()->clientScript->registerScript($this->popupID, "
		$(window).bind('load', function() {
			var errorMsgs = $('$contentSelector div.errorMessage');
			if (errorMsgs.length > 0) {
				for (i = 0; i < errorMsgs.length; ++i) {
					if ($(errorMsgs[i]).css('display') != 'none') {
						$('$linkSelector').click();
						return false;
					}
				}
			}
		});");
?>