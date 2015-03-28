<?php
/* @var $this CrudBeerStyleController */
/* @var $model BaseBeerStyle */

$this->breadcrumbs=array(
	'Base Beer Styles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseBeerStyle', 'url'=>array('index')),
	array('label'=>'Manage BaseBeerStyle', 'url'=>array('admin')),
);
?>

<h1>Create BaseBeerStyle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>