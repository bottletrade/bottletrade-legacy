<?php
/* @var $this CrudBreweryController */
/* @var $model BaseBrewery */

$this->breadcrumbs=array(
	'Base Breweries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseBrewery', 'url'=>array('index')),
	array('label'=>'Manage BaseBrewery', 'url'=>array('admin')),
);
?>

<h1>Create BaseBrewery</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>