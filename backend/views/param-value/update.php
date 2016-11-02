<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ParamValue */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Param Value',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Param Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="param-value-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
