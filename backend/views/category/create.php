<?php


/* @var $this yii\web\View */
/* @var $model common\models\Example */

$this->title = Yii::t('app', 'Create Category');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="example-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
