<?php
/* @var $this CrudReviewController */
/* @var $model BaseReview */

$this->breadcrumbs=array(
	'Base Reviews'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List BaseReview', 'url'=>array('index')),
	array('label'=>'Create BaseReview', 'url'=>array('create')),
	array('label'=>'Update BaseReview', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete BaseReview', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BaseReview', 'url'=>array('admin')),
);
?>

<h1>View BaseReview #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TradeID',
		'UserTo',
		'UserFrom',
		'Rating',
		'Message',
	),
)); ?>
