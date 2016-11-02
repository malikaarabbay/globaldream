<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\Param;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategoryParamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Category Params');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-param-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category Param'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'cateory_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Категория',
                'value' => function ($data) {
                    return ($data->category) ? $data->category->title : '-';
                },
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'title')
            ],
            [
                'attribute' => 'param_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Параметр',
                'value' => function ($data) {
                    return ($data->param) ? $data->param->title : '-';
                },
                'filter' => ArrayHelper::map(Param::find()->all(), 'id', 'title')
            ],
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>
