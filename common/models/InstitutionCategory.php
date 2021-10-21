<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "institution_mode".
 *
 * @property int $id
 * @property string|null $name
 */
class InstitutionCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\InstitutionModeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\InstitutionModeQuery(get_called_class());
    }
}
