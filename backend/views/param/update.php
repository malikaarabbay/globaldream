<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Param */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Param',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="param-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
