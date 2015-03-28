<div class="top-banner center" style="padding: 20px 0px; height: auto; display: block; background-repeat: repeat-y;">
	<span class="white-title ti-medium"><?php echo $brewery->Name; ?></span>
</div>
<div class="single-page-content" style="padding-top: 30px; margin-top: -5px;">
	<div style="float: left; width: 200px; height: 200px;">
		<img src="<?php echo ImageUtils::getCompanyImageUrl($brewery); ?>" width="200px" height="200px">
	</div>
	<div style="float: left; width: 570px; height: auto; overflow: auto; display: block; padding-top: 12px;">
	<table class="info-page black-medium">
		<?php if (empty($brewery->Name)): ?>
		<?php else: ?>
		<tr>
			<td>Brewery Name: </td>
			<td><?php echo $brewery->Name; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Address1)): ?>
		<?php else: ?>
		<tr>
			<td>Street Address: </td>
			<td><?php echo $brewery->Address1; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Address2)): ?>
		<?php else: ?>
		<tr>
			<td>Extended Address: </td>
			<td><?php echo $brewery->Address2; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->City)): ?>
		<?php else: ?>
		<tr>
			<td>City: </td>
			<td><?php echo $brewery->City; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->State)): ?>
		<?php else: ?>
		<tr>
			<td>State: </td>
			<td><?php echo $brewery->State; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Code)): ?>
		<?php else: ?>
		<tr>
			<td>Code: </td>
			<td><?php echo $brewery->Code; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Country)): ?>
		<?php else: ?>
		<tr>
			<td>Country: </td>
			<td><?php echo $brewery->Country; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Phone)): ?>
		<?php else: ?>
		<tr>
			<td>Phone: </td>
			<td><?php echo $brewery->Phone; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Established)): ?>
		<?php else: ?>
		<tr>
			<td>Established: </td>
			<td><?php echo $brewery->Established; ?></td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Website)): ?>
		<?php else: ?>
		<tr>
			<td>Website: </td>
			<td>
				<?php 
					$url = $brewery->Website;
					if (!StringUtils::startsWith($url, "http://") && !StringUtils::startsWith($url, "https://")) {
						if (!StringUtils::startsWith($url, "www.")) {
							$url = "www.".$url;
						}
						$url = "http://".$url;
					}
				?>
				<a href='<?php echo $url; ?>' target='_blank'><?php echo $brewery->Website; ?></a>
			
			</td>
		</tr>
		<?php endif; ?>
		
		<?php if (empty($brewery->Description)): ?>
		<?php else: ?>
		<tr>
			<td>Description: </td>
			<td><?php echo $brewery->Description; ?></td>
		</tr>
		<?php endif; ?>
	</table>
	</div>
</div>
