<?php
/* @var $this CrudBeerCategoryController */
/* @var $model BaseBeerCategory */

$this->breadcrumbs=array(
	'Base Beer Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseBeerCategory', 'url'=>array('index')),
	array('label'=>'Manage BaseBeerCategory', 'url'=>array('admin')),
);
?>

<h1>Create BaseBeerCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>