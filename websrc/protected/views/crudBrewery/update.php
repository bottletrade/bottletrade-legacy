<?php
/* @var $this CrudBreweryController */
/* @var $model BaseBrewery */

$this->breadcrumbs=array(
	'Base Breweries'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseBrewery', 'url'=>array('index')),
	array('label'=>'Create BaseBrewery', 'url'=>array('create')),
	array('label'=>'View BaseBrewery', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseBrewery', 'url'=>array('admin')),
);
?>

<h1>Update BaseBrewery <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>