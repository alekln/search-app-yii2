<?php

use yii\grid\GridView;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
//use yii\bootstrap4\Dropdown;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
use kartik\bs4dropdown\Dropdown;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Employee';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index p-4">

    <?php
    $pjaxContainerId = 'employee-search';
    $filterFormName = 'users-form';
    timurmelnikov\widgets\LoadingOverlayPjax::begin([
        'id' => $pjaxContainerId,
        'color' => 'rgba(63, 127, 191, 0.4) ',
        'fontawesome' => 'fa fa-spinner fa-spin',
        'minSize' => "20px",
        'size' => "10%",
        'enablePushState' => true,
        'enableReplaceState' => true,
        'timeout' => false
    ]);

    $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'id' => $filterFormName,
                'data-pjax' => true,
            ],
        ]);

    ?>

    <div class="">
        <?php
        $this->registerJs('
            $("select#employeequery-institution_mode").change(function(){
                let value = this.value;
                $("#employeequery-institution_name").val("");
                window.updateDropDown("' . Yii::$app->urlManager->createUrl('custom-data/institution-type') . '?mode="+value, $("select#employeequery-institution_type"), true)
            });
    
    
            $("select#employeequery-institution_mode, input#employeequery-address_region, input#employeequery-address_province, input#employeequery-address_municipality, select#employeequery-institution_type, select#employeequery-position_type").on("change", function(){
                $("#employeequery-institution_name").val("");
                window.updateAutocomplete("' . Yii::$app->urlManager->createUrl('custom-data/institution') . '");
            });
        ');
        ?>
        <div class="site-search">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'options' => [
                            'class' => 'pagination float-right'
                        ],
                        'prevPageLabel' => '←',
                        'nextPageLabel' => '→'
                    ],
                    'layout' => "
                            <div class='row'>
                                <div class='col'>{pager}</div>
                                <div class='col-5 text-right '></div>
                            </div>
                            <div class='row mt-5'>{items}</div>
                            <div class='row'>
                                <div class='col'>{pager}</div>
                                <div class='col-5 text-right '>{summary}</div>
                            </div>
                    ",
                    'options' => [
                        'style'=>'word-wrap: break-word;'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'employee.institution',
                            'label'=>'Institution',
                            'contentOptions' => ['style' => 'width: 120px'],
                            'format' => "raw",
                            'value' =>  function ($model) {
                                foreach($model->institution as $inst){
                                    return $inst !== null ? Html::a($inst->short_name, $inst->home_page, ['target'=>'_blank']) . '<br/>': '' ;
                                }
                            }
                        ],
                        [
                            'attribute' => 'employee.education.name',
                            'label'=>'Haridus',
                            'contentOptions' => ['style' => 'width: 120px'],
                            'format' => 'html',
                            'value' =>  function ($model) {
                                return $model->education->name;
                            }
                        ],
                        [
                            'attribute' => 'employee.position.name',
                            'label'=>'Ametikoht',
                            'contentOptions' => ['style' => 'width: 120px'],
                            'format' => 'html',
                            'value' =>  function ($model) {

                                return $model->position !== null ? $model->position->name : '';
                            }
                        ],
                        [
                            'attribute' => 'employee.subjects',
                            'label'=>'Õpetatavad õppeained',
                            'contentOptions' => ['style' => 'width: 220px'],
                            'format' => 'html',
                            'value' =>  function ($model) {
                                $subjects = '';
                                foreach($model->subjects as $data){
                                    $subjects .=  sprintf('<li>%s</li><br/>', $data->name);
                                }
                                if(!empty($subjects)) {
                                    $subjects = sprintf('<ol>%s</ol>', $subjects);
                                }

                                return $subjects;
                            }
                        ],
                        [
                            'attribute' => 'employee.qualification.name',
                            'label'=>'Kvalifikatsiooni kategooria',
                            'format' => 'html',
                            'value' =>  function ($model) {
                                return $model->qualification->name;
                            }
                        ],
                        [
                            'attribute' => 'employee.qualification.name',
                            'label'=>'Pedagoogiline nimetus',
                            'format' => 'html',
                            'value' =>  function ($model) {

                                return $model->position !== null ? $model->position->pedagogical_name : '';
                            }
                        ], [
                            'attribute' => 'employee.qualification.name',
                            'label'=>'Pedagoogiline staaz',
                            'format' => 'html',
                            'contentOptions' => [
                                'style'=>'max-width:100px; min-height:100px; overflow: auto; word-wrap: break-word;'
                            ],
                            'value' =>  function ($model) {
                                return $model->getStandingPeriod();
                            }
                        ],
                        [
                            'attribute' => 'birth_date',
                            'label'=>'Sünniaasta',
                            'contentOptions' => ['style' => 'width: 120px'],
                            'value' =>  function ($model) {
                                return date("Y", strtotime($model->birth_date));
                            }
                        ],

                    ],
                ]); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row  mb-2">
                        <div class="col-lg-12">
                            <?php
                                echo Html::label('Piirkond');
                            ?>

                            <div class="dropdown">
                                <?php

                                echo Html::button($model->address_query, [
                                    'id' => 'dropdownMenuButton',
                                    'class' => 'btn btn-default dropdown-toggle',
                                    'style'=>'width:400px; text-overflow: ellipsis; overflow:hidden;text-align:left;',
                                    'data-toggle' => 'dropdown',
                                    'aria-haspopup' => 'true',
                                    'aria-expanded' => 'false'
                                ]);

                                $ddItems = [];
                                $ddItems[] = ['linkOptions'=>[
                                        'data-region'=>0,
                                        'style'=>'display:inline-block; height:30px;',
                                        'data-fullname'=>''
                                ], 'label' => '', 'url'=>'javascript:void(0)'];
                                foreach(\common\models\AddressRegion::find()->asArray()->all() as $region){

                                    $item = [
                                            'linkOptions'=>[
                                                'data-region'=>$region['id'],
                                                'data-fullname'=>sprintf('%s', $region['name'])
                                            ],
                                            'label' => $region['name'],
                                            'url'=>'javascript:void(0)'
                                    ];
                                    foreach(\common\models\AddressProvince::find()->where(['region_id'=>$region['id']])->asArray()->all() as $province){
                                        $item1 = [
                                                'linkOptions'=>[
                                                    'data-region'=>$region['id'],
                                                    'data-province'=>$province['id'],
                                                    'data-fullname'=>sprintf('%s, %s', $region['name'], $province['name'])
                                                ],
                                                'label' => $province['name'],
                                                'url'=>'javascript:void(0)'
                                        ];
                                        foreach(\common\models\AddressMuncipality::find()->where(['province_id'=>$province['id']])->asArray()->all() as $municipality) {
                                            $item2 = [
                                                    'linkOptions'=>[
                                                        'data-region'=>$region['id'],
                                                        'data-province'=>$province['id'],
                                                        'data-municipality'=>$municipality['id'],
                                                        'data-fullname'=>sprintf('%s, %s, %s', $region['name'], $province['name'], $municipality['name'])
                                                    ],
                                                    'label' => $municipality['name'],
                                                    'url' => 'javascript:void(0)'
                                            ];
                                            $item1['items'][] = $item2;
                                        }
                                        $item['items'][] = $item1;
                                    }

                                    $ddItems [] = $item;
                                    //$ddItems
                                }

                                echo Dropdown::widget([
                                    'items' => $ddItems,
                                    'options' => ['aria-labelledby' => 'dropdownMenuButton', 'class'=>'regionDDList']
                                ]);
                                ?>
                                <?= $form->field($model, 'address_query')->hiddenInput()->label(false); ?>
                                <?= $form->field($model, 'address_region')->hiddenInput()->label(false); ?>
                                <?= $form->field($model, 'address_province')->hiddenInput()->label(false); ?>
                                <?= $form->field($model, 'address_municipality')->hiddenInput()->label(false); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <?= $form->field($model,
                                'institution_mode')->dropDownList(ArrayHelper::map(\common\models\InstitutionCategory::find()->All(),
                                'id',
                                'name'), ['autofocus' => true, 'prompt' => '']); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model,
                                'institution_type')->dropDownList(ArrayHelper::map(\common\models\InstitutionType::find()->All(),
                                'id',
                                'name'),
                                ['autofocus' => true, 'prompt' => '']); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'institution_name')->textInput(['list'=>'institutionList']); ?>
                            <datalist id="institutionList">
                                <?php foreach(\common\models\Institution::find()->all() as $inst){
                                    echo Html::tag('option', $inst->name);
                                }?>
                            </datalist>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'last_name')->textInput(['autofocus' => true]); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'patronymic')->textInput(['autofocus' => true]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <?= $form->field($model, 'birth_date')->textInput(['autofocus' => true]); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'birth_date_starts')->textInput(['autofocus' => true]); ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'birth_date_ends')->textInput(['autofocus' => true]); ?>
                        </div>
                    </div>
                    <?= $form->field($model, 'gender')->dropdownList([\common\models\Employee::GENDER_MEN => 'Mees', \common\models\Employee::GENDER_WOMAN => 'Naine'],
                        ['autofocus' => true, 'multiple' => 'multiple']); ?>


                    <div class="row">
                        <div class="col-lg">
                            <?= $form->field($model,
                                'position_type')->dropDownList(ArrayHelper::map(\common\models\PositionType::find()->All(),
                                'id',
                                'name'), ['autofocus' => true, 'prompt' => '']) ?>
                        </div>
                        <div class="col-lg">
                            <?= $form->field($model, 'position')->dropDownList(ArrayHelper::map(\common\models\Position::find()->All(),
                                'id',
                                'name'),
                                ['autofocus' => true, 'multiple' => 'multiple']) ?>
                        </div>
                    </div>
                    <?= $form->field($model,
                        'education_level')->dropDownList(ArrayHelper::map(\common\models\EducationType::find()->All(), 'id',
                        'name'), ['autofocus' => true, 'multiple' => 'multiple']) ?>
                    <?= $form->field($model, 'fired_search')->dropdownList(["no"=>'Ei', "yes"=>'Jah'], ['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Otsi', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
                        <?= Html::a( 'Tühista',
                             Yii::$app->getHomeUrl() . 'search/index',
                            ['class' => 'btn btn-default ']) ?>
                        <?= Html::a( 'Eksport CSV',
                            'javascript:exportCSV(`' . Yii::$app->getHomeUrl() . 'search/export-csv`,`#users-form`)',
                            ['name' => 'exportData', 'class' => 'float-right']) ?>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <?php ActiveForm::end(); ?>
    <?php timurmelnikov\widgets\LoadingOverlayPjax::end(); ?>

</div>
