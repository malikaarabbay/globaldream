<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('app', 'Update Product') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
        'image_tab' => $image_tab,
        'params' => $category->params,
        'productParamModel' => $productParamModel,
    ]) ?>

    <?php Modal::begin([
        'id' => 'updateImageTitleModal',
        'header' => 'Название изображении',
        'size' => 'modal-md',
    ]); ?>

        <div class='modalContent'></div>

    <?php Modal::end(); ?>
</div>
