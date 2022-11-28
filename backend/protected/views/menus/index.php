<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menuses',
);

$this->menu=array(
	array('label'=>'Create Menus', 'url'=>array('create')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>Menuses</h1>
<div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>