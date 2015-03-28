<?php
/* @var $this CrudReviewController */
/* @var $model BaseReview */

$this->breadcrumbs=array(
	'Base Reviews'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List BaseReview', 'url'=>array('index')),
	array('label'=>'Create BaseReview', 'url'=>array('create')),
	array('label'=>'View BaseReview', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage BaseReview', 'url'=>array('admin')),
);
?>

<h1>Update BaseReview <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>