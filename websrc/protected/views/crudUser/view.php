<?php
/* @var $this CrudUserController */
/* @var $model BaseUser */

$this->breadcrumbs=array(
	'Base Users'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List BaseUser', 'url'=>array('index')),
	array('label'=>'Create BaseUser', 'url'=>array('create')),
	array('label'=>'Update BaseUser', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseUser', 'url'=>array('admin')),
);
?>

<h1>View BaseUser #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Username',
		'Password',
		'Email',
		'FirstName',
		'LastName',
		'Birthday',
		'Address',
		'City',
		'DisplayCity',
		'State',
		'Country',
		'Zip',
		'Links',
		'About',
		'ImagePath',
		'IsActive',
		'IsPrivate',
		'EmailPreferences',
		'ForgotPasswordToken',
		'ForgotPasswordTokenExpiration',
		'CreatedTime',
	),
)); ?>
