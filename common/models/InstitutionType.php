<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "institution_type".
 *
 * @property int $id
 * @property string $name
 */
class InstitutionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution_type';
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
     * @return \common\models\search\InstitutionTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\InstitutionTypeQuery(get_called_class());
    }
}
