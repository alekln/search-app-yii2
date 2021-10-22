<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "positions".
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $name
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name', 'pedagogical_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\PositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\PositionQuery(get_called_class());
    }

    /**
     * Gets query for [[Qualification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQualification()
    {
        return $this->hasOne(QualificationCategory::className(), ['id' => 'qualification_id'])
            ->viaTable('employee_position', ['employee_id'=>'id']);
    }
}
