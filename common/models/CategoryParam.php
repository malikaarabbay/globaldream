<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category_param}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $param_id
 */
class CategoryParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'param_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'param_id' => Yii::t('app', 'Param ID'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getParam()
    {
        return $this->hasOne(Param::className(), ['id' => 'param_id']);
    }
}
