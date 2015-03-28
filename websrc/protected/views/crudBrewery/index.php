<?php
/* @var $this CrudBreweryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Breweries',
);

$this->menu=array(
	array('label'=>'Create BaseBrewery', 'url'=>array('create')),
	array('label'=>'Manage BaseBrewery', 'url'=>array('admin')),
);
?>

<h1>Base Breweries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
