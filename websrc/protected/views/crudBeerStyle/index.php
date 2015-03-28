<?php
/* @var $this CrudBeerStyleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Beer Styles',
);

$this->menu=array(
	array('label'=>'Create BaseBeerStyle', 'url'=>array('create')),
	array('label'=>'Manage BaseBeerStyle', 'url'=>array('admin')),
);
?>

<h1>Base Beer Styles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
