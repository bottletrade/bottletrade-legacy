<?php
/* @var $this CrudBeerStyleController */
/* @var $model BaseBeerStyle */

$this->breadcrumbs=array(
	'Base Beer Styles'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List BaseBeerStyle', 'url'=>array('index')),
	array('label'=>'Create BaseBeerStyle', 'url'=>array('create')),
	array('label'=>'Update BaseBeerStyle', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseBeerStyle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseBeerStyle', 'url'=>array('admin')),
);
?>

<h1>View BaseBeerStyle #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'CategoryID',
		'Name',
		'LastUpdateTime',
	),
)); ?>
