<?php
/* @var $this CrudUserController */
/* @var $model BaseUser */

$this->breadcrumbs=array(
	'Base Users'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseUser', 'url'=>array('index')),
	array('label'=>'Create BaseUser', 'url'=>array('create')),
	array('label'=>'View BaseUser', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseUser', 'url'=>array('admin')),
);
?>

<h1>Update BaseUser <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>