<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryParam */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Category Param',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="category-param-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
