<h1>User Emails</h1>
<table>
	<?php foreach ($data['users'] as $user) { ?>
	<tr><td><?php echo $user->Email; ?></td></tr>
	<?php } ?>
</table>