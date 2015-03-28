<?php
/* @var $this CrudBeerController */
/* @var $model BaseBeer */

$this->breadcrumbs=array(
	'Base Beers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseBeer', 'url'=>array('index')),
	array('label'=>'Manage BaseBeer', 'url'=>array('admin')),
);
?>

<h1>Create BaseBeer</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>