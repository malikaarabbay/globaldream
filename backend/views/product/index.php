<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    
    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => Yii::t('object', 'Product'),
        ]), ['select-category'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->image,['width'=>50]);
                },
            ],
            [
                'attribute' => 'category_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Категория',
                'value' => function ($data) {
                    return ($data->category) ? $data->category->title : '-';
                },
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'title')
            ],
            'title',
            'price',
            'new_price',
//            'anounce:ntext',
//            'description:ntext',
            //'photo',
            // 'status',
            // 'created',
            // 'updated',
//            'is_published',
            'created:datetime',
            [
                'attribute' => 'is_main',
                'class' => 'yii\grid\DataColumn',
                'label' => 'На главную',
                'value' => function ($data) {
                    return ($data->is_main) ? Yii::$app->params['is_main'][$data->is_main] : '';
                },
                'filter' => Yii::$app->params['is_main']
            ],
            [
                'attribute' => 'is_published',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Опубликован',
                'value' => function ($data) {
                    return ($data->is_published) ? Yii::$app->params['published'][$data->is_published] : '';
                },
                'filter' => Yii::$app->params['published']
            ],
            // 'meta_keywords:ntext',
            // 'meta_description:ntext',
            // 'slug',
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>

</div>
