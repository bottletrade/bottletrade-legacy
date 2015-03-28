<?php
/* @var $this CrudReviewController */
/* @var $model BaseReview */

$this->breadcrumbs=array(
	'Base Reviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BaseReview', 'url'=>array('index')),
	array('label'=>'Manage BaseReview', 'url'=>array('admin')),
);
?>

<h1>Create BaseReview</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>