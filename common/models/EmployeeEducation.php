<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_education".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property int|null $education_id
 */
class EmployeeEducation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'education_id'], 'integer'],
            ['created_at', 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'education_id' => 'Education ID',
        ];
    }
}
