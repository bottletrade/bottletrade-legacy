<?php
/* @var $this CrudBeerCategoryController */
/* @var $model BaseBeerCategory */

$this->breadcrumbs=array(
	'Base Beer Categories'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BaseBeerCategory', 'url'=>array('index')),
	array('label'=>'Create BaseBeerCategory', 'url'=>array('create')),
	array('label'=>'Update BaseBeerCategory', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseBeerCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseBeerCategory', 'url'=>array('admin')),
);
?>

<h1>View BaseBeerCategory #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'LastUpdateTime',
	),
)); ?>
