<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Param */

$this->title = Yii::t('app', 'Create Param');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
