<?php
/* @var $this CrudUserController */
/* @var $model BaseUser */

$this->breadcrumbs=array(
	'Base Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseUser', 'url'=>array('index')),
	array('label'=>'Manage BaseUser', 'url'=>array('admin')),
);
?>

<h1>Create BaseUser</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>