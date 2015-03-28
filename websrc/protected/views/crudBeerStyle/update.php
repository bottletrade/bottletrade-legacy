<?php
/* @var $this CrudBeerStyleController */
/* @var $model BaseBeerStyle */

$this->breadcrumbs=array(
	'Base Beer Styles'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseBeerStyle', 'url'=>array('index')),
	array('label'=>'Create BaseBeerStyle', 'url'=>array('create')),
	array('label'=>'View BaseBeerStyle', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseBeerStyle', 'url'=>array('admin')),
);
?>

<h1>Update BaseBeerStyle <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>