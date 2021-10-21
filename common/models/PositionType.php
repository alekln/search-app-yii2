<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "position_type".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type
 */
class PositionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\PositionTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\PositionTypeQuery(get_called_class());
    }
}
