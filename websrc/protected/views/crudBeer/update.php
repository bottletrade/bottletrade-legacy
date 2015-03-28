<?php
/* @var $this CrudBeerController */
/* @var $model BaseBeer */

$this->breadcrumbs=array(
	'Base Beers'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseBeer', 'url'=>array('index')),
	array('label'=>'Create BaseBeer', 'url'=>array('create')),
	array('label'=>'View BaseBeer', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseBeer', 'url'=>array('admin')),
);
?>

<h1>Update BaseBeer <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>