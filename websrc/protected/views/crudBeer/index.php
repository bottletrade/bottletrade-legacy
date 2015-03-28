<?php
/* @var $this CrudBeerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Beers',
);

$this->menu=array(
	array('label'=>'Create BaseBeer', 'url'=>array('create')),
	array('label'=>'Manage BaseBeer', 'url'=>array('admin')),
);
?>

<h1>Base Beers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
