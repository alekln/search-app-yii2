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

    public function getEmployeePositions(){

        return $this->hasMany(EmployeePosition::class, ['employee_id'=>'id']);
    }

    public function getEmployeeEducation(){
        return $this->hasMany(EmployeeEducation::class, ['employee_id'=> 'id']);
    }

    public function getLatestEducation(){
        $education = EducationType::find()
            ->joinWith('employeeEducation')
            ->where(['employee_education.employee_id'=>$this->id])
            ->orderBy(['employee_education.graduated_at'=> SORT_DESC])
            ->one();

        if($education !== null){
            return $education->name;
        }

        return "";
    }


    public function getQualification(){
        return $this->hasOne(QualificationCategory::class, ['id'=>'qualification_id']);
    }
    public function getEducation(){
        return $this->hasMany(EducationType::class, ['id'=>'education_id'])
            ->viaTable('employee_education', ['employee_id'=>'id']);
    }
    public function getSubjects(){
        return $this->hasMany(Subjects::class, ['id'=>'subject_id'])
            ->viaTable('employee_subjects', ['employee_id'=>'id']);
    }

    public function getStandingPeriod(){
        $positions = $this->employeePositions;
        $years = 0;
        $months = 0;
        foreach($positions as $position) {
            $employed_at = $position->employeed_at;
            $end_date = "";

            if ($this->status == static::STATUS_FIRED) {
                $end_date = $this->termination_at;
            }

            $firstDate = new \DateTime($employed_at);
            $secondDate = new \DateTime($end_date);

            $intvl = $firstDate->diff($secondDate);
            $years += $intvl->y;
            $months += $intvl->m;
        }

        return sprintf('%d aastat ja %d kuud', $years, $months);
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
