<?php 
//create a link
echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));

//put fancybox on page
$contentSelector = '#'.$this->popupID;
$linkSelector = '#'.$this->linkID;
$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
		'linkSelector'=>$linkSelector,
		'contentSelector'=>$contentSelector
));
?>

<div id="<?php echo $this->popupID; ?>" class="popup mfp-hide in-search-of">
	<img src="<?php echo UrlUtils::generateImageUrl("iso/title_icon.png"); ?>" width="180" height="140"/><br>
	<?php if ($this->isCurrentUser): ?>
		<span class="black">ISO (IN SEARCH OF) IS A WISHLIST OF ALL BOTTLES YOU ARE CURRENTLY LOOKING TO TRADE FOR. IF YOU WANT 
			TO ADD TO THIS LIST, PLEASE SEARCH BELOW AND CLICK ON THE "ADD TO ISO" BUTTON.
		</span>
	<?php else: ?>
		<span class="black">THIS IS <?php echo strtoupper($this->user->Username); ?>'S ISO (IN SEARCH OF) WISHLIST OF ALL BOTTLES THEY ARE CURRENTLY LOOKING TO TRADE FOR. 
		PLEASE CONSIDER THESE BOTTLES WHEN OFFERING UP BOTTLES FOR A TRADE.
		</span>
	<?php endif; ?>
		<br />
	<?php if ($this->isCurrentUser): ?>
		<table width="300px" align="center">
			<tr>
				<td>
					<input id="SearchTermID" type="text" placeholder="Enter Bottle Name"></input>
				</td>
				<td align="left">
					<button class="medium" onclick="
						$(this).attr('disabled','disabled');
						var searchQuery = '<?php echo UrlUtils::generateUrl(UrlUtils::SearchUri); ?>/' + $('#SearchTermID').val();
						window.location = searchQuery;
						return false;">
							SEARCH
					</button>
				</td>
			</tr>
		</table>
	<?php endif; ?>
		<br />
		<span class="black">ISO BOTTLES</span><br />
		<div class="event-container iso-container">
			<div class="iso-empty" data-bind="visible: !$root.IsoManager().loader().loadingData() && $root.EventManager().iso().length == 0">
				<?php if (!$this->isCurrentUser): ?>
					<span class="black"><?php echo $this->user->Username; ?> has not entered any bottles into their ISO</span>
				<?php else: ?>
					<span class="black">You have not entered any bottles into your ISO</span>
				<?php endif; ?>
			</div>
			<div data-bind="foreach: $root.EventManager().iso">
				<div class="iso-bottle-holder">
					<div class="iso-bottle-image">
						<img data-bind="attr: { src: imgSrc }" width="80px" height="80px" />
					</div>
					<div class="iso-bottle-copy">
						<a data-bind="attr: { href: beverageUrl }, text: beverageName"></a>
						<br/>
						<a data-bind="attr: { href: companyUrl }, text: companyName"></a>
						<?php if ($this->isCurrentUser): ?>
						<div>
							<button data-bind="visible: isEditable, click: $root.IsoManager().removeEntry" class="medium" style="width: auto;">REMOVE FROM ISO</button>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="horizontal-divide"></div>
			</div>
			<div data-bind="visible: $root.IsoManager().loader().loadingData" class="center">
				<img src="<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>" width="40px" height="40px"/>
			</div>
		</div>
	<div style="width: 500px; height: 35px; margin: 5px auto; text-align: center;">
		<button class='medium' onclick='$.magnificPopup.close(); return false;'>CLOSE</button>
	</div>
</div>

<script>
$(window).load(function() {
	// have magnific popup reset form before closing
	$('#<?php echo $this->linkID; ?>').on('mfpBeforeOpen', function(e /*, params */) {
		KnockoutManager.IsoManager().loader().loadMore();
	});
	
	KnockoutManager.IsoManager(new _IsoManager());
	
	// do initial load of data
	KnockoutManager.IsoManager().loader().dataUrl(bottletrade.apis.iso.getEntries);
	KnockoutManager.IsoManager().loader().customUrlData('<?php echo "un=".$this->user->Username; ?>');
	KnockoutManager.IsoManager().loader().limit(1000);
});
</script>
