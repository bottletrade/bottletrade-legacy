<?php
/* @var $this CrudUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Users',
);

$this->menu=array(
	array('label'=>'Create BaseUser', 'url'=>array('create')),
	array('label'=>'Manage BaseUser', 'url'=>array('admin')),
);
?>

<h1>Base Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
