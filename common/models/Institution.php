<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "institution".
 *
 * @property int $id
 * @property string $created_at
 * @property string $name
 * @property string|null $short_name
 * @property string|null $home_page
 * @property string|null $category
 * @property string|null $type
 *
 * @property EmployeeInstitution[] $employeeInstitutions
 */
class Institution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name'], 'required'],
            [['home_page'], 'string'],
            [['name'], 'string', 'max' => 500],
            [['short_name', 'category', 'type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'name' => 'Institution',
            'short_name' => 'Short Name',
            'home_page' => 'Home Page',
            'category' => 'Category',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[EmployeeInstitutions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\search\EmployeeInstitutionQuery
     */
    public function getEmployeeInstitutions()
    {
        return $this->hasMany(EmployeeInstitution::className(), ['institution_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\search\InstitutionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\InstitutionQuery(get_called_class());
    }

    public static function getRegions(){
        return [];//static::find()->select(['region as name'])->groupBy(['region'])->asArray()->all();
    }

    public static function getProvince($region = null){
        return [];//
        /*$query = static::find()->select(['province as name'])->groupBy(['province'])->asArray();

        if($region !== null){
            $query->andWhere(['region'=>$region]);
        }

        return $query->all();*/
    }
    public static function getMunicipality($province = null){
        return [];//
        /*$query = static::find()->select('municipality  as name')->groupBy(['municipality'])->asArray();

        if($province !== null){
            $query->andWhere(['province'=>$province]);
        }

        return $query->all();*/
    }
}
