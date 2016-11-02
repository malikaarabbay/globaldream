<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('object', 'Select Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="object-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table table-striped">
        <tr>
            <th>Категория</th>
        </tr>
        <?php foreach($categories as $category){ ?>

            <tr>
                <td>
                    <a href="<?= Url::toRoute(['create', 'category_id' => $category->id])?>"><?= $category->title ?></a>
                </td>
            </tr>
        <?php } ?>

        </table>

</div>
