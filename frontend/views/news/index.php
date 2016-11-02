<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = 'Акции и новости';

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);

?>
<div class="news-section">
    <div class="news-section__inner">
        <div class="h-heading h-heading--black">
            <h6>Акции и новости</h6>
        </div>
        <ul class="news-ul">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'layout' => "{items}\n<div class='clearfix'></div>{pager}",
            ]) ?>
        </ul>
    </div>
</div>
