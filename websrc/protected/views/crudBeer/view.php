<?php
/* @var $this CrudBeerController */
/* @var $model BaseBeer */

$this->breadcrumbs=array(
	'Base Beers'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BaseBeer', 'url'=>array('index')),
	array('label'=>'Create BaseBeer', 'url'=>array('create')),
	array('label'=>'Update BaseBeer', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseBeer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseBeer', 'url'=>array('admin')),
);
?>

<h1>View BaseBeer #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'BreweryID',
		'Name',
		'StyleID',
		'ABV',
		'IBU',
		'SRM',
		'UPC',
		'Availability',
		'ImagePath',
		'Description',
		'UserAdded',
		'CreatedTime',
		'LastUpdateTime',
	),
)); ?>
