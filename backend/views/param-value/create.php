<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ParamValue */

$this->title = Yii::t('app', 'Create Param Value');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Param Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-value-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
