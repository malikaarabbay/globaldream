<?php

namespace frontend\widgets;

use common\models\Category;
use yii\base\Widget;

class CatalogWidget extends Widget
{

    public function init()
    {
        parent::init();

        $categories = Category::find()->where(['is_published' => '1', 'parent_id' => null])->all();

        echo $this->render('catalog', [
            'categories' => $categories,
        ]);

    }

}
