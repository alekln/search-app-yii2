<?php

namespace common\models\search;

use common\models\Employee;
use yii\data\ActiveDataProvider;
use codeonyii\yii2validators\AtLeastValidator;

/**
 * This is the ActiveQuery class for [[\common\models\Employee]].
 *
 * @see \common\models\Employee
 */
class EmployeeQuery extends Employee
{

    public ?string $area = null;
    public ?string $institution_name = null;
    public ?string $birth_date_starts = null;
    public ?string $birth_date_ends = null;
    public ?string $institution_mode = null;
    public ?string $institution_type = null;
    public ?string $fired_search = null;
    public ?string $position_type = null;

    //ignoring type definition related to validaton problems
    public $position = null;
    public $education_level = null;

    public ?string $address_region = null;
    public ?string $address_municipality = null;
    public ?string $address_province = null;
    public ?string $address_query = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required

            [
                [
                    'first_name',
                    'last_name',
                    'institution_name',
                    'patronymic',
                    'area',
                    'fired_search',
                    'birth_date',
                    'birth_date_starts',
                    'birth_date_ends',
                    'institution_mode',
                    'institution_type',
                    'institution',
                    'position_type',
                    'address_query',
                    'gender',
                    'address_region',
                    'address_province',
                    'address_municipality',
                    'education_level',
                    'position'
                ],
                AtLeastValidator::className(),
                'in'=>[
                    'first_name',
                    'last_name',
                    'institution_name',
                    'patronymic',
                    'area',
                    'fired_search',
                    'birth_date',
                    'birth_date_starts',
                    'birth_date_ends',
                    'institution_mode',
                    'institution_type',
                    'institution',
                    'position_type',
                    'address_query',
                    'gender',
                    'address_region',
                    'address_province',
                    'address_municipality',
                    'education_level',
                    'position'
                ],
                'message'=>'At least one field must be selected to proceed',
                'min'=>1
            ],
            [
                [
                    'first_name',
                    'last_name',
                    'institution_name',
                    'patronymic',
                    'area',

                ],
                'string',
                'min'=>2,
                'skipOnEmpty'=>true
            ],
            ['birth_date', 'integer', 'max' => date('Y'), 'min' => 1900],
            [['birth_date_starts', 'birth_date_ends'], 'integer', 'max' => 100, 'min' => 10],
            [
                [
                    'birth_date',
                    'birth_date_starts',
                    'birth_date_ends',
                    'institution_mode',
                    'institution_type',
                    'position_type',

                ],
                'integer'
            ],
            [
                [
                    'address_query',
                    'gender',
                    'institution_mode',
                    'institution_type',
                    'institution',
                    'first_name',
                    'last_name',
                    'address_region',
                    'address_province',
                    'address_municipality',
                    'education_level',
                    'position',
                    'fired_search'
                ],
                'safe'
            ],

            // rememberMe must be a boolean value
        ];
    }

    public function attributeLabels()
    {
        return [
            'area' => 'Piirkond',
            'institution_mode' => 'Õppeasutuse liik',
            'institution_type' => 'Õppeasutuse tüüp',
            'institution_name' => 'Õppeasutuse nimetus',
            'first_name' => 'Eesnimi',
            'last_name' => 'Perekonnanimi',
            'patronymic' => 'Isanimi',
            'birth_date' => 'Sünniaasta',
            'birth_date_starts' => 'Vanus alates',
            'birth_date_ends' => 'Vanus kuni',
            'gender' => 'Sugu',
            'position_type' => 'Ametikoha liik', //ADD
            'position' => 'Ametikoht', //ADD
            'education_level' => 'Haridustase', //ADD
            'fired_search' => 'Otsi ka vallandatute hulgast', //ADD
        ];
    }



    /**
     * {@inheritdoc}
     * @return \common\models\Employee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Employee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function search($params)
    {
        $query = Employee::find()->distinct()->joinWith([
            'institution',
            'employeeEducation',
            'employeePositions',
            'employeePositions.position'
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'page' => (isset($params['page']) ? $params['page'] - 1 : 0),
                'pageSize' => (isset($params['pageSize']) ? $params['pageSize'] : 10),
            ],
        ]);

        if (is_null($params) || empty($params)) {
            $query->where('false');
            return $dataProvider;
        }

        $dataProvider->setSort([
            'defaultOrder' => ['created_at' => SORT_DESC],
            'attributes' => [
                'id',
                'created_at',
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails

            $query->where('false');

            return $dataProvider;
        }

        if (isset($this->address_region) && !empty($this->address_region)) {
            $query->andFilterWhere(['institution.region_id' => $this->address_region]);
        }

        if (isset($this->address_province) && !empty($this->address_province)) {
            $query->andFilterWhere(['institution.province_id' => $this->address_province]);
        }

        if (isset($this->address_municipality) && !empty($this->address_municipality)) {
            $query->andFilterWhere(['institution.municipality_id' => $this->address_municipality]);
        }

        if (isset($this->education_level) && !empty($this->education_level)) {
            $query->andFilterWhere(['employee_education.education_id' => $this->education_level]);
        }

        if (isset($this->institution_mode)) {
            $query->andFilterWhere(['institution.category' => $this->institution_mode]);
        }

        if (isset($this->institution_type)) {
            $query->andFilterWhere(['institution.type' => $this->institution_type]);
        }

        if (isset($this->institution_name) && !empty($this->institution_name)) {
            $query->andFilterWhere(['like', 'LOWER(institution.name)', strtolower($this->institution_name)]);
        }

        if (isset($this->position) && !empty($this->position)) {
            $query->andFilterWhere(['IN', 'position.id', $this->position]);
        }

        if (isset($this->position_type)) {
            $query->andFilterWhere(['position.type' => $this->position_type]);
        }

        if (isset($this->first_name)) {
            $query->andFilterWhere(['like', 'employee.first_name', $this->first_name]);
        }

        if (isset($this->last_name)) {
            $query->andFilterWhere(['like', 'employee.last_name', $this->last_name]);
        }

        if (isset($this->patronymic)) {
            $query->andFilterWhere(['like', 'employee.patronymic', $this->patronymic]);
        }

        if (isset($this->gender)) {
            $query->andFilterWhere(['employee.gender' => $this->gender]);
        }

        if (isset($this->birth_date)) {
            $query->andFilterWhere(['=', 'YEAR(employee.birth_date)', $this->birth_date]);
        }

        if (isset($this->birth_date_starts)) {
            $query->andFilterWhere(['>=', 'YEAR(CURRENT_DATE()) - YEAR(birth_date)', $this->birth_date_starts]);
        }

        if (isset($this->birth_date_ends)) {
            $query->andFilterWhere(['<=', 'YEAR(CURRENT_DATE()) - YEAR(birth_date)', $this->birth_date_ends]);
        }

        if ($this->fired_search !== "yes") {
            $query->andFilterWhere(['employee.status' => Employee::STATUS_ACTIVE]);
        }


        if (isset($this->id)) {
            $query->andFilterWhere(['employee.id' => $this->id]);
        }
        // echo $query->createCommand()->getRawSql();
        return $dataProvider;
    }

    public function exportCSV($params)
    {

        $search = $this->search($params);

        $models = $search->getModels();


        /* header section */

        $filename = null;
        $exclude = [];
        $data = "";

        $instance = self::instance();

        if ($filename == null) {
            $filename = "export_" . date('d.m.Y') . ".csv";
        }

        $attr_count = 0;
        $data .= "Institution";
        $data .= ";Haridus";
        $data .= ";Ametikoht";
        $data .= ";Õpetatavad õppeained";
        $data .= ";Kvalifikatsiooni kategooria";
        $data .= ";Pedagoogiline nimetus";
        $data .= ";Pedagoogiline staaz";
        $data .= ";Sünniaasta";


        $data .= "\r\n";

        /* header section EOL */
        if (count($models) > 0) {

            foreach ($models as $model) {
                $relations = $model->employeePositions;
                $outputEducation = $qualifications = $outputPositions = "";
                $coma = "";
                foreach ($relations as $relation) {
                    $outputPositions .= $coma . $relation->position->name;
                    $qualifications .= $coma . $relation->position->name . " - " . $relation->qualification->name;
                    $coma = ", ";
                }

                $data .= $model->institution !== null && count($model->institution) > 0 ? $model->institution[0]->short_name : "";
                $data .= ";" . $model->getLatestEducation();
                $data .= ";\"" . $outputPositions . "\"";
                $data .= ";\"" . $model->getSubjectsAsString() . "\"";
                $data .= ";\"" . $outputPositions . "\"";
                $data .= ";\"" . $qualifications . "\"";
                $data .= ";" . $model->getStandingPeriod();
                $data .= ";" . date("Y", strtotime($model->birth_date));

                $data .= "\r\n";
            }
        }
        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
        exit(1);
    }
}
