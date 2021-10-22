<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_position".
 *
 * @property int $id
 * @property int|null $employee_id
 * @property int|null $position_id
 * @property string|null $employeed_at
 * @property int|null $qualification_id
 *
 * @property Employee $employee
 * @property Position $position
 * @property QualificationCategory $qualification
 */
class EmployeePosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'position_id', 'qualification_id'], 'integer'],
            [['employeed_at'], 'safe'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['qualification_id'], 'exist', 'skipOnError' => true, 'targetClass' => QualificationCategory::className(), 'targetAttribute' => ['qualification_id' => 'id']],
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
            'position_id' => 'Position ID',
            'employeed_at' => 'Employeed At',
            'qualification_id' => 'Qualification ID',
        ];
    }


    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Qualification]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQualification()
    {
        return $this->hasOne(QualificationCategory::className(), ['id' => 'qualification_id']);
    }
}
