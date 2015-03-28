<?php 

$rootContainerSelector = "#".$this->popupID;
$imageCropperSelector = $rootContainerSelector." .image-cropper";
$loadingImageUrl = UrlUtils::generateImageUrl("ajax-loader.gif");

// include ajax file upload widget, only include once
if ($renderOnly) :
	//create a link
	echo CHtml::link("Upload", '#'.$this->popupID, array('id'=>$this->linkID, 'class'=>'hidden'));
	
	//put fancybox on page
	$contentSelector = '#'.$this->popupID;
	$linkSelector = '#'.$this->linkID;
	$this->controller->widget('application.extensions.magnific-popup.XMagnificPopup', array(
			'linkSelector'=>$linkSelector,
			'contentSelector'=>$contentSelector
	));
	
	$baseImageUrl = UrlUtils::generateAbsoluteUrl("fileView","showTempImage");
	
	if (Yii::app()->detectMobileBrowser->getIsMobile()) {
		$initCropSize = 300;
	} else {
		$initCropSize = 100;
	}
?>
<div class="hidden">
 <?php 
		$this->widget('ext.EAjaxUpload.EAjaxUpload',
				array(
						'id'=>'uploadFile',
						'config'=>array(
								'action'=>Yii::app()->createUrl('fileUpload/uploadTempImage'),
								'allowedExtensions'=>array("jpg","jpeg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
								'sizeLimit'=>5*1024*1024,// maximum file size in bytes
								//'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
								'onSubmit' => "js:function(id, fileName){
									$('#cropImageLoading').show();
									$('.image-action-crop').attr('disabled','disabled');
									$('.image-action-rotate-left').attr('disabled','disabled');
									$('.image-action-rotate-right').attr('disabled','disabled');
									resetCropper();
									$('#$this->linkID').click();
								}",
								'onCancel' => "js:function(id, fileName){
								}",
								'onComplete'=>"js:function(id, fileName, responseJSON){
									ImageModificationManager.filename = responseJSON['filename'];
									$('.image-action-crop').removeAttr('disabled');
									$('#cropImageLoading').hide();
									if (!Modernizr.filereader) {
										$('$imageCropperSelector').removeAttr('width');
										$('$imageCropperSelector').removeAttr('height');
										var fileUrl = '$baseImageUrl' + '/?filename=' + fileName;
										$('$imageCropperSelector').attr('src', fileUrl);
										
										$('$imageCropperSelector').load(function() {
											$('.image-action-rotate-left').removeAttr('disabled');
											$('.image-action-rotate-right').removeAttr('disabled');
							        		rotateImage(0);
										});
									}
								}",
								'messages'=>array(
								'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
								'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
								'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
								'emptyError'=>"{file} is empty, please select files again without it.",
				  						             'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
  						            ),
									//'showMessage'=>"js:function(message){ alert(message); }"
								)
						));
		
		if(Yii::app()->detectMobileBrowser->getIsMobile()) {
			$rotateBtnClass = "box";
			$otherBtnClass = "large";
		} else {
			$rotateBtnClass = "box";
			$otherBtnClass = "medium";
		}
	?>
</div>
<div id="<?php echo $this->popupID; ?>" class="mfp-hide image-crop-popup-main-container">
	<div class="image-cropper-container">
		<img class='image-cropper' alt=""/>
		<table class="image-crop-button-table">
			<tr>
				<td>
					<button class="<?php echo $rotateBtnClass; ?> image-action-rotate-left" onclick="js:rotateImage(-90); return false;"></button>
			 		<button class="<?php echo $rotateBtnClass; ?> image-action-rotate-right" onclick="js:rotateImage(90); return false;"></button>
				</td>
				<td>
					<div class="center">
						<img id="cropImageLoading" style="display:none;" class="loading small" src='<?php echo UrlUtils::generateImageUrl("ajax-loader.gif"); ?>'></img>
						<br/>
						<button class="<?php echo $otherBtnClass; ?> image-action-crop" onclick="js:cropImage(); return false;">Crop / Save</button>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<button class="<?php echo $otherBtnClass; ?> image-action-upload" onclick="js:uploadImage(); return false;">Change Pic</button>
				</td>
				<td>
					<button class="<?php echo $otherBtnClass; ?> image-action-cancel" onclick="js:cancelCrop(); return false;">Cancel</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript">
$(window).load(function() {
<?php if (Yii::app()->detectMobileBrowser->getIsMobile()): ?>
	$(".image-crop-popup-main-container").addClass("mobile");
	$(".image-cropper-container").addClass("mobile");
	$(".image-crop-button-table").addClass("mobile");
	$(".image-cropper").addClass("mobile");
<?php endif; ?>
});
	
var _ImageModifierManager = function() {
	this.onComplete = "function(filename, fileurl) {}";
	this.onCancel = "function() {}";
	this.beforeOpen = "function() {}";
	this.imgPreviewId = "";

	this.resetData = function() {
		this.filename = "";
		this.naturalHeight = 0;
		this.naturalWidth = 0;
		this.clientHeight = 0;
		this.clientWidth = 0;
		this.cropHeight = 0;
		this.cropWidth = 0;
		this.cropTop = 0;
		this.cropLeft = 0;
		this.rotate = 0;
	};
}
window.ImageModificationManager = new _ImageModifierManager();
ImageModificationManager.resetData();

function resetImgAreaSelector() {
    $('<?php echo $imageCropperSelector; ?>').imgAreaSelect({ disable: true, hide: true });
    var imgCrop = $('<?php echo $imageCropperSelector; ?>')[0];

	var imgWidth = imgCrop.width;
	var imgHeight = imgCrop.height;

	// create coordinates to center picture
	var defaultX1 = (imgWidth - <?php echo $initCropSize; ?>) / 2;
	var defaultX2 = (imgWidth + <?php echo $initCropSize; ?>) / 2;
	var defaultY1 = (imgHeight - <?php echo $initCropSize; ?>) / 2;
	var defaultY2 = (imgHeight + <?php echo $initCropSize; ?>) / 2;

	ImageModificationManager.naturalWidth = imgCrop.naturalWidth;
	ImageModificationManager.naturalHeight = imgCrop.naturalHeight;
	ImageModificationManager.clientWidth = imgCrop.clientWidth;
	ImageModificationManager.clientHeight = imgCrop.clientHeight;
	ImageModificationManager.filename;
	ImageModificationManager.cropHeight = defaultY2 - defaultY1;
	ImageModificationManager.cropWidth = defaultX2 - defaultX1;
	ImageModificationManager.cropTop = defaultY1;
	ImageModificationManager.cropLeft = defaultX1;
	
	$(imgCrop).imgAreaSelect({
		enable: true,
		handles: true,
		aspectRatio: '1:1',
		minHeight: 100,
		minWidth: 100,
		fadeSpeed : 1,
		show: true,
		x1: defaultX1, 
		x2: defaultX2, 
		y1: defaultY1, 
		y2: defaultY2,
		onSelectEnd: function (img, selection) {
			ImageModificationManager.cropHeight = selection.height;
			ImageModificationManager.cropWidth = selection.width;
			ImageModificationManager.cropTop = selection.y1;
			ImageModificationManager.cropLeft = selection.x1;
		}
	});
}

function resetCropper() {
	var imgCrop = $('<?php echo $imageCropperSelector; ?>')[0];
	$(imgCrop).attr('src', '<?php echo $loadingImageUrl; ?>');
	$(imgCrop).attr('width', '40px');
	$(imgCrop).attr('height', '40px');
	$(imgCrop).load(function() {
		rotateImage(0);
	    $('<?php echo $imageCropperSelector; ?>').imgAreaSelect({ disable: true, hide: true });
	});
	
	$(imgCrop).css({
		'-webkit-transform': 'rotate(0deg)',
        '-ms-transform': 'rotate(0deg)',
        '-moz-transform': 'rotate(0deg)',
        '-o-transform': 'rotate(0deg)',
        'transform': 'rotate(0deg)'
	});

	$('.imgareaselect-outer').data('rotated', 0);
	$('.imgareaselect-outer').data('translatedY', 0);
	$('.imgareaselect-outer').data('translatedX', 0);

	ImageModificationManager.resetData();

	var w=window.innerWidth
	|| document.documentElement.clientWidth
	|| document.body.clientWidth;

	var h=window.innerHeight
		|| document.documentElement.clientHeight
		|| document.body.clientHeight;
<?php if(Yii::app()->detectMobileBrowser->getIsMobile()): ?>
	var btnTableHeight = 122;//$('.image-crop-button-table').height();
	var btnTableWidth = 430;//$('.image-crop-button-table').width();
<?php else: ?>
	var btnTableHeight = 106;//$('.image-crop-button-table').height();
	var btnTableWidth = 260;//$('.image-crop-button-table').width();
<?php endif; ?>
	var popCont = $('.image-crop-popup-main-container')[0];
	var padVert = parseInt($(popCont).css('padding-top')) + parseInt($(popCont).css('padding-bottom'));
	var padHoriz = parseInt($(popCont).css('padding-left')) + parseInt($(popCont).css('padding-right'));
	
	// figure out avaiable min/max to maintain aspect ratio
	var maxH = (h * 0.9) - (btnTableHeight + padVert);
	var maxW = w * 0.9;
	if (maxH/maxW != 1) {
		if (maxH > maxW) { maxH = maxW; }
		else { maxW = maxH; }
	}
	var minH = (h * 0.3) - (btnTableHeight + padVert);
	var minW = w * 0.3;
	if (minH/minW != 1) {
		if (minH > minW) { minH = minW; } 
		else { minW = minH; }
	}
	
	$("img.image-cropper").css("max-height", maxH);
	$("img.image-cropper").css("max-width", maxW);
	$("img.image-cropper").css("min-height", minH);
	$("img.image-cropper").css("min-width", minW);
	$(".image-cropper-container").css("min-height", minH + btnTableHeight);
	$(".image-cropper-container").css("min-width", btnTableWidth + padHoriz);
	$(".image-cropper-container").css("max-height", h * 0.9);
	$(".image-cropper-container").css("max-width", w * 0.9);
	$(".image-crop-popup-main-container").css("min-height", minH + btnTableHeight + padVert);
	$(".image-crop-popup-main-container").css("min-width", btnTableWidth + padHoriz);
	$(".image-crop-popup-main-container").css("max-height", h * 0.9);
	$(".image-crop-popup-main-container").css("max-width", w * 0.9);
}

function cancelCrop() {
    resetCropper();
    ImageModificationManager.onCancel();
}

function uploadImage() {
    if (Modernizr.filereader) {
		$('#uploadFile input[type="file"]').change(function(e) {
			readURL(e.target);
	    }); 
    }
    resetCropper();
    $('#uploadFile input[type="file"]').click();
}

function cropImage() {
	$('#cropImageLoading').show();
	$.ajax({
	    type: 'post',
	    url: '<?php echo Yii::app()->createUrl('fileUpload/cropTempImage'); ?>',
	    data: {
		    	'filename': ImageModificationManager.filename, 
		    	'nheight': ImageModificationManager.naturalHeight, 
		    	'nwidth': ImageModificationManager.naturalWidth, 
		    	'cheight': ImageModificationManager.clientHeight, 
		    	'cwidth': ImageModificationManager.clientWidth, 
		    	'height': ImageModificationManager.cropHeight, 
		    	'width': ImageModificationManager.cropWidth, 
		    	'top': ImageModificationManager.cropTop, 
		    	'left': ImageModificationManager.cropLeft,
		    	'rotate': ImageModificationManager.rotate 
		},
	    dataType: 'json',
	    error: function(data){
		    alert("Crop was unsucessful, please try again later.  We appologize for the inconvenience.");
		    $('#cropImageLoading').hide();
	    },
	    success: function(data){
		    var fileName = ImageModificationManager.filename;
		    var fileUrl = '<?php echo $baseImageUrl; ?>' + '/?filename=' + fileName + "&v=" + '<?php echo StringUtils::generateRandomString(5); ?>';

			var imgSelector = '#' + ImageModificationManager.imgPreviewId;
		    $(imgSelector).attr('src', '<?php echo $loadingImageUrl; ?>');
		    
		    var ias = $('<?php echo $imageCropperSelector; ?>').imgAreaSelect({ instance: true });
		    ias.setOptions({ disable: true, hide: true });
		    
		    $(imgSelector).attr('src', fileUrl);
		    $('#cropImageLoading').hide();
		    ImageModificationManager.onComplete(fileName, fileUrl);
	    }
	});
}

function rotateImage(deg) {
	var imgCrop = $('<?php echo $imageCropperSelector; ?>')[0];
	ImageModificationManager.rotate += deg;
	// only handle degs between 0 - 270 to make life easier
	if (ImageModificationManager.rotate == -90) {
		ImageModificationManager.rotate = 270;
	} else if (ImageModificationManager.rotate == 360) {
		ImageModificationManager.rotate = 0;
	}
	var transHoriz = (imgCrop.clientWidth > imgCrop.clientHeight ? (imgCrop.clientWidth-imgCrop.clientHeight)/2 : 0);
	var transVert = (imgCrop.clientHeight > imgCrop.clientWidth ? (imgCrop.clientHeight-imgCrop.clientWidth)/2 : 0);
	var transFunc = "";
	if ((ImageModificationManager.rotate/90 % 2) != 0) {
		// image rotated 90 or 270 deg, need to perform translate
		var is90deg = (ImageModificationManager.rotate/90 % 4) == 1; // else 270

		if (transVert > 0) {
			// orig image is < 1 aspect ratio, must move button table down
			var margBot = 2 * -transVert;
			if (is90deg) {
				$(imgCrop).css({ marginBottom: (2*-transVert) });
			} else {
				$(imgCrop).css({ marginTop: (2*-transVert) });
			}
			$('.imgareaselect-outer').data('translatedY', -transVert);
			$('.imgareaselect-outer').data('translatedX', -transVert);
			var transFunc = 'translateY(' + (is90deg ? -transVert : transVert) + 'px) translateX(-' + transVert + 'px)';
		} else {
			// orig image is > 1 aspect ratio, must move button table up
			$('.image-crop-button-table').css({ paddingTop: 2*transHoriz});
			$('.imgareaselect-outer').data('translatedY', transHoriz);
			$('.imgareaselect-outer').data('translatedX', transHoriz);

			transVal = is90deg ? transHoriz : -transHoriz;
			var transFunc = 'translateY(' + (is90deg ? transHoriz : -transHoriz) + 'px) translateX(' + transVal + 'px)';
		}
	} else {
		$('.imgareaselect-outer').data('translatedY', 0);
		$('.imgareaselect-outer').data('translatedX', 0);
		$('.image-crop-button-table').css({ paddingTop: 0});
		$(imgCrop).css({ marginTop: 0 });
		$(imgCrop).css({ marginBottom: 0 });
	}
		
	$(imgCrop).css({
		'-webkit-transform': 'rotate(' + ImageModificationManager.rotate + 'deg) ' + transFunc,
        '-moz-transform': 'rotate(' + ImageModificationManager.rotate + 'deg) ' + transFunc,
        '-ms-transform': 'rotate(' + ImageModificationManager.rotate + 'deg) ' + transFunc,
        '-o-transform': 'rotate(' + ImageModificationManager.rotate + 'deg) ' + transFunc,
        'transform': 'rotate(' + ImageModificationManager.rotate + 'deg) ' + transFunc,
	});
	$('.imgareaselect-outer').data('rotated', ImageModificationManager.rotate);
	
	var btnTable = $('.image-crop-button-table')[0];
	var popCont = $('.image-crop-popup-main-container')[0];
	var padWidth = parseInt($(popCont).css('padding-left')) + parseInt($(popCont).css('padding-right'));
	var padHeight = parseInt($(popCont).css('padding-top')) + parseInt($(popCont).css('padding-bottom'));
	if ((ImageModificationManager.rotate/90 % 2) == 0) {
		// image is rotated 0 or 180 deg
		var imgWidth = imgCrop.clientWidth;
		var imgHeight = imgCrop.clientHeight;
	} else {
		// image is rotated 90 or 270 deg
		var imgWidth = imgCrop.clientHeight;
		var imgHeight = imgCrop.clientWidth;
	}
	$('.image-crop-popup-main-container').css('width', imgWidth + padWidth);
	$('.image-crop-popup-main-container').css('height', imgHeight + btnTable.clientHeight + padHeight);

	$('.image-cropper-container').css('width', imgWidth);
	$('.image-cropper-container').css('height', imgHeight + btnTable.clientHeight);
	resetImgAreaSelector(null);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
			$('<?php echo $imageCropperSelector; ?>').removeAttr('width');
			$('<?php echo $imageCropperSelector; ?>').removeAttr('height');
            $('<?php echo $imageCropperSelector; ?>').attr('src', e.target.result);
			$('<?php echo $imageCropperSelector; ?>').load(function() {
				$('.image-action-rotate-left').removeAttr('disabled');
				$('.image-action-rotate-right').removeAttr('disabled');
				rotateImage(0);			});
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php endif; // if EAjaxUpload not included ?>
<?php 
$funcName = "initModifier".$config['imgPreviewId'];
?>
<?php if (!$renderOnly && !empty($config)): ?>
<div>
	<img 	id="<?php echo $config['imgPreviewId']; ?>" 
			data-bind="<?php echo $config['imgDataBind']; ?>" 
			src="<?php echo $config['defaultImageSrc']; ?>" 
			class="image-crop-preview"
			width="160px" height="160px" />
	<br/>
	<button class="medium" onclick="return <?php echo $funcName; ?>();">Upload Picture</button>
</div>
<script type="text/javascript">
function <?php echo $funcName; ?>() {
	$('<?php echo $imageCropperSelector; ?>').imgAreaSelect({ hide: true });
	ImageModificationManager.imgPreviewId = '<?php echo $config['imgPreviewId']; ?>'; 
<?php if (array_key_exists('onComplete', $config)) : ?>
	ImageModificationManager.onComplete = <?php echo $config['onComplete']; ?>; 
<?php endif; ?>
<?php if (array_key_exists('onCancel', $config)) : ?>
	ImageModificationManager.onCancel = <?php echo $config['onCancel']; ?>; 
<?php endif; ?>
<?php if (array_key_exists('beforeOpen', $config)) : ?>
	ImageModificationManager.beforeOpen = <?php echo $config['beforeOpen']; ?>; 
	ImageModificationManager.beforeOpen();
<?php endif; ?>
    if (Modernizr.filereader) {
		$('#uploadFile input[type="file"]').change(function(e) {
			readURL(e.target);
	    }); 
    }
	$('#uploadFile input[type="file"]').click();
	return false;
}
</script>
<?php endif; ?>