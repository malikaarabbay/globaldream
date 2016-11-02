<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%param}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $deleted
 * @property integer $is_filter
 * @property integer $sort_index
 */
class Param extends \yii\db\ActiveRecord
{
    const TYPE_TEXT = 1;
    const TYPE_SELECT = 2;
    const TYPE_CHECKBOXLIST = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'deleted', 'is_filter', 'sort_index'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type_id' => Yii::t('app', 'Type ID'),
            'deleted' => Yii::t('app', 'Deleted'),
            'is_filter' => Yii::t('app', 'Is Filter'),
            'sort_index' => Yii::t('app', 'Sort Index'),
        ];
    }

    public function getParamValues(){
        return $this->hasMany(ParamValue::className(), ['param_id' => 'id']);
    }
}
