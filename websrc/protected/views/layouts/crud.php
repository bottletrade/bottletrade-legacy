
<?php $this->beginContent('/layouts/main'); ?>
<div id="menu2">
	<div style="width: 100%; height: 33px; margin-left: auto; margin-right: auto; padding-top:12px;">
		<ul>
			<li><a class="crudbutton" href="<?php echo UrlUtils::generateUrl(Yii::app()->controller->id); ?>">VIEW ALL</a></li>
			<li><a class="crudbutton" href="<?php echo UrlUtils::generateUrl(Yii::app()->controller->id."/Create"); ?>">CREATE</a></li>
			<li><a class="crudbutton" href="<?php echo UrlUtils::generateUrl(Yii::app()->controller->id."/Admin"); ?>">MANAGE EXISTING</a></li>
		</ul>
	</div>
</div>
<div style="padding-top: 45px;">
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>