<?php
/* @var $this CrudBeerCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Beer Categories',
);

$this->menu=array(
	array('label'=>'Create BaseBeerCategory', 'url'=>array('create')),
	array('label'=>'Manage BaseBeerCategory', 'url'=>array('admin')),
);
?>

<h1>Base Beer Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
