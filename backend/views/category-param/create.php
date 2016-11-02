<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoryParam */

$this->title = Yii::t('app', 'Create Category Param');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-param-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
