<?php
/* @var $this CrudBreweryController */
/* @var $model BaseBrewery */

$this->breadcrumbs=array(
	'Base Breweries'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BaseBrewery', 'url'=>array('index')),
	array('label'=>'Create BaseBrewery', 'url'=>array('create')),
	array('label'=>'Update BaseBrewery', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseBrewery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseBrewery', 'url'=>array('admin')),
);
?>

<h1>View BaseBrewery #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'Address1',
		'Address2',
		'City',
		'State',
		'Code',
		'Country',
		'Phone',
		'Established',
		'Website',
		'ImagePath',
		'Description',
		'UserAdded',
		'CreatedTime',
		'LastUpdateTime',
	),
)); ?>
