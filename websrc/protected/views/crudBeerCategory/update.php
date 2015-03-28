<?php
/* @var $this CrudBeerCategoryController */
/* @var $model BaseBeerCategory */

$this->breadcrumbs=array(
	'Base Beer Categories'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseBeerCategory', 'url'=>array('index')),
	array('label'=>'Create BaseBeerCategory', 'url'=>array('create')),
	array('label'=>'View BaseBeerCategory', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseBeerCategory', 'url'=>array('admin')),
);
?>

<h1>Update BaseBeerCategory <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>