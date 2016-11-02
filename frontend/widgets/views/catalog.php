<?php
use yii\helpers\Url;
use common\models\Category;
?>
<div class="filter-section">
    <?php foreach ($categories as $category) { ?>
    <div class="filter">
        <a class="directory" href="<?= Url::toRoute(['/catalog/view', 'slug' => $category->slug]) ?>"><?= $category->title ?></a>
        <ul class="filter-ul">
            <?php $parentCategories = Category::find()->where(['is_published' => '1', 'parent_id' => $category->id])->all(); ?>
            <?php foreach ($parentCategories as $parentCategory) { ?>
            <li class="filter-ul__li">
                <a href="<?= Url::toRoute(['/catalog/view', 'slug' => $parentCategory->slug]) ?>"><?= $parentCategory->title ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
</div>

