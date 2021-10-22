<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "education_type".
 *
 * @property int $id
 * @property string|null $name
 */
class EducationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'education_type';
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

    public function getEmployeeEducation(){
        return $this->hasMany(EmployeeEducation::class, ['education_id'=> 'id']);
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
     * @return \common\models\search\EducationTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\EducationTypeQuery(get_called_class());
    }
}
