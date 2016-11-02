<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ParamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Params');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Param'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'type_id',
                'class' => 'yii\grid\DataColumn',
                'label' => 'Тип',
                'value' => function ($data) {
                    return ($data->type_id) ? Yii::$app->params['paramTypes'][$data->type_id] : '';
                },
                'filter' => Yii::$app->params['paramTypes']
            ],
            // 'sort_index',
            [
                'header' => 'Действия',
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>
