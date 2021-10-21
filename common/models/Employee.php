<?php

namespace common\models;

    use common\components\ExtActiveRecord;

use Yii;

/**
 * This is the model class for table "institution_type".
 *
 * @property int $id
 * @property string $name
 */
class Employee extends ExtActiveRecord
{
    public const STATUS_FIRED = '-1';

    public const STATUS_ACTIVE = '1';

    public const STATUS_VACATION = '2';

    public const GENDER_MEN = 1;

    public const GENDER_WOMAN = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    public function getEducation(){
        return $this->hasOne(EducationType::class, ['id'=>'education_id']);
    }

    public function getPosition(){
        return $this->hasOne(Position::class, ['id'=>'position_id']);
    }
    public function getQualification(){
        return $this->hasOne(QualificationCategory::class, ['id'=>'qualification_id']);
    }

    public function getSubjects(){
        return $this->hasMany(Subjects::class, ['id'=>'subject_id'])
            ->viaTable('employee_subjects', ['employee_id'=>'id']);
    }

    public function getStandingPeriod(){
        $employed_at = $this->employed_at;
        $end_date = "";

        if($this->status == static::STATUS_FIRED){
            $end_date = $this->termination_at;
        }

        $firstDate  = new \DateTime($employed_at);
        $secondDate = new \DateTime($end_date);

        $intvl = $firstDate->diff($secondDate);
        return sprintf('%d aastat ja %d kuud', $intvl->y, $intvl->m);
    }

    public function getSubjectsAsString(){
        $str = "";
        $i = 0;

        $subjects = $this->subjects;

        if(count($subjects) > 0) {
            foreach ($subjects as $subject) {

                $str .= $subject->name;
                if (count($subjects) > ++$i) {
                    $str .= ", ";
                }

            }
        }
        return $str;
    }

    public function getInstitution(){
        return $this->hasMany(Institution::class, ['id'=>'institution_id'])
             ->viaTable('employee_institution', ['employee_id'=>'id']);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'status'], 'string', 'max' => 255],
            [['first_name'  ], 'safe']
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


}
