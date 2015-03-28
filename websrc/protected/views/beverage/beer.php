<table>
	
</table>
<div class="top-banner center" style="padding: 20px 0px; height: auto; display: block; background-repeat: repeat-y;">
	<span class="white-title ti-medium"><?php echo $beer->Name; ?></span>
</div>
<div class="single-page-content" style="padding-top: 30px; margin-top: -5px;">
	<div style="float: left; width: 200px; height: 200px;">
		<img src="<?php echo ImageUtils::getBeverageImageUrl($beer); ?>" width="200px" height="200px">
	</div>
	<div style="float: left; width: 570px; height: auto; overflow: auto; display: block; padding-top: 12px;">
	<table class="info-page black-medium">
		<?php if (empty($beer->Name)): ?>
		<?php else: ?>
		<tr>
			<td>Beer Name: </td>
			<td><?php echo $beer->Name; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->brewery)): ?>
		<?php else: ?>
		<tr>
			<td>Brewery: </td>
			<td><a href="<?php echo UrlUtils::getCompanyUrl($beer->brewery); ?>"><?php echo $beer->brewery->Name; ?></a></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->style->Name)): ?>
		<?php else: ?>
		<tr>
			<td>Style: </td>
			<td><?php echo $beer->style->Name; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->ABV)): ?>
		<?php else: ?>
		<tr>
			<td>ABV: </td>
			<td><?php echo $beer->ABV; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->IBU)): ?>
		<?php else: ?>
		<tr>
			<td>IBU: </td>
			<td><?php echo $beer->IBU; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->SRM)): ?>
		<?php else: ?>
		<tr>
			<td>SRM: </td>
			<td><?php echo $beer->SRM; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->UPC)): ?>
		<?php else: ?>
		<tr>
			<td>UPC: </td>
			<td><?php echo $beer->UPC; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->Availability)): ?>
		<?php else: ?>
		<tr>
			<td>Availability: </td>
			<td><?php echo $beer->Availability; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($beer->Description)): ?>
		<?php else: ?>
		<tr>
			<td>Description: </td>
			<td><?php echo $beer->Description; ?></td>
		</tr>
		<?php endif; ?>
	</table>
</div>
</div>