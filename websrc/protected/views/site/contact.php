<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
?>
<div class="top-banner">
	<div style="text-align: center;">
		<span class="white-title ti-large" style="text-align: center;">CONTACT US</span>
	</div>
</div>
<div class="single-page-content">
<br />
	<?php $contactUsFormWidget=$this->beginWidget('CActiveForm', array(
                                                    'id'=>'contact-us-form',
                                                    'enableAjaxValidation'=>false,
                                                    'clientOptions'=>array(
                                                     	'validateOnSubmit'=>true,
														'validateOnType'=>false,
														'validateOnChange'=>false,
                                                    ),
													'enableClientValidation'=>true,
                                                    )); ?>
	<span class="black">
	BottleTrade is a trading network comprised of craft beer enthusiasts from around the world. 
	The many tools and features implemented throughout the site are meant to promote the culture, 
	art and craft behind the beer community. We strive to provide the highest level of support and 
	customer service for each and every one of our users.<br><br>

If you have any questions in regards to the site or recent purchases, feel free to shoot us an email 
at <a class="underline" href="mailto:support@bottletrade.com">support@bottletrade.com</a> or fill out the contact form below.
	</span>
			<table class="contact-input">
			<tr>
				<td>
					<?php echo $contactUsFormWidget->labelEx($contactUsForm,'email'); ?></td>
				<td>
					<?php echo $contactUsFormWidget->textField($contactUsForm,'email'); ?>
					<?php echo $contactUsFormWidget->error($contactUsForm,'email'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $contactUsFormWidget->labelEx($contactUsForm,'topic'); ?></td>
				<td>
					<?php echo $contactUsFormWidget->dropDownList(
					    $contactUsForm,
					    'topic',
					    FormUtils::createDropdownList(array_merge(array('Choose topic...'),ContactUsForm::getTopics()))); ?>
					<?php echo $contactUsFormWidget->error($contactUsForm,'topic'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $contactUsFormWidget->labelEx($contactUsForm,'message'); ?></td>
				<td>
					<?php echo $contactUsFormWidget->textArea($contactUsForm,'message'); ?>
					<?php echo $contactUsFormWidget->error($contactUsForm,'message'); ?>
				</td>
			</tr>
			<tr>
			<td>
			</td>
				<td><?php echo CHtml::submitButton('Send', array('class'=> 'medium')); ?></td>
		</table>
	<?php $this->endWidget(); ?>
</div>