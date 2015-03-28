<?php
/* @var $this CrudReviewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Base Reviews',
);

$this->menu=array(
	array('label'=>'Create BaseReview', 'url'=>array('create')),
	array('label'=>'Manage BaseReview', 'url'=>array('admin')),
);
?>

<h1>Base Reviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
