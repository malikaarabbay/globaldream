<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%product_param}}".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $param_id
 * @property string $value
 */
class ProductParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'param_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'param_id' => Yii::t('app', 'Param ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public function getParam()
    {
        return $this->hasOne(Param::className(), ['id' => 'param_id']);
    }

    public function getImage()
    {
        return $this->hasOne(ParamValue::className(), ['param_id' => 'param_id']);
    }

    public function getParamValue()
    {
        return $this->hasOne(ParamValue::className(), ['id' => 'value']);
    }

    public function getParamValues()
    {
        return $this->hasMany(ParamValue::className(), ['id' => 'value']);
    }

    public function afterFind()
    {

        parent::afterFind();
//        $this->value = ($this->param->type_id == Param::TYPE_CHECKBOXLIST) ? explode(',', $this->value) : $this->value;
        $this->value = ($this->param && $this->param->type_id == Param::TYPE_CHECKBOXLIST) ? explode(',', $this->value) : $this->value;
    }

    public function getValueText()
    {

        if ($this->param) {
            switch ($this->param->type_id) {
                // Для селектов дастаем значения и парсим
                case Param::TYPE_CHECKBOXLIST:
                    if ($this->paramValues) {
                        return implode(',', $this->paramValues ? ArrayHelper::getColumn($this->paramValues, 'value') : '');
                    }
                    break;
                case Param::TYPE_TEXT:
                    return $this->value;
                    break;
                case Param::TYPE_SELECT:
                    return $this->paramValue ? $this->paramValue->value : '';
                    break;
            }
        }

    }

    public function getValuePhoto()
    {

        if ($this->param) {
            switch ($this->param->type_id) {
                // Для селектов дастаем значения и парсим
                case Param::TYPE_CHECKBOXLIST:
                    if ($this->paramValues) {
                        return implode(',', $this->paramValues ? ArrayHelper::getColumn($this->paramValues, 'photo') : '');
                    }
                    break;
                case Param::TYPE_TEXT:
                    return $this->photo;
                    break;
                case Param::TYPE_SELECT:
                    return $this->paramPhoto ? $this->paramPhoto->photo : '';
                    break;
            }
        }

    }
}
