<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use frontend\widgets\CatalogWidget;

/* @var $this yii\web\View */
$this->title = 'Каталог';

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  '']);
$this->registerMetaTag(['name'=> 'description', 'content' => '']);

?>
<div class="catalog">
    <div class="catalog__inner">
        <div class="h-heading h-heading--black">
            <h6>Каталог</h6>
        </div>
        <div class="filter-part">
            <?= CatalogWidget::widget(); ?>

            <div class="filter-section">
                <div class="filter-section__heading">
                    Поиск
                </div>
                <div class="search-wr">
                <form id="search-form" action="/catalog/search" method="get" role="form">
                    <input type="search" id="search-query" name="Search[query]" class="search-wr__input" placeholder="">
<!--                    <input onclick="document.getElementById('search-form').submit()" class="s_submit" type="submit" value="Найти">-->
                </form>
                </div>
                
            </div>
        </div>
        <div class="catalog-part">
            <ul class="filter-carousel">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_item',
                    'layout' => "{items}\n<div class='clearfix'></div>{pager}",
                ]) ?>
            </ul>
        </div>
    </div>
</div>