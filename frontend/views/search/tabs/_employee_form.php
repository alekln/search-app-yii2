<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ContactForm */


use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

?>

<?php

$this->registerJs('
     $("select#searchform-institution_mode").change(function(){
        let value = this.value;
        window.updateDropDown("' . Yii::$app->urlManager->createUrl('custom-data/institution-type') . '?mode="+value, $("select#searchform-institution_type"))
    });
    $("select#searchform-position_type").change(function(){
        let value = this.value;
        window.updateDropDown("' . Yii::$app->urlManager->createUrl('custom-data/position') . '?mode="+value, $("select#searchform-position"), false)
    });
');
?>

<div class="site-search">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg">
                    <?= $form->field($model, 'area')->dropdownList(['Linn', 'Kihelkond', 'Maakond', 'Riig'],
                        ['autofocus' => true, 'prompt'=>'']); ?>
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
            <?= $form->field($model, 'gender')->dropdownList(['1' => 'Mees', '2' => 'Naine'],
                ['autofocus' => true, 'multiple' => 'multiple']); ?>

            <div class="row">
                <div class="col-lg">
                    <?= $form->field($model,
                        'institution_mode')->dropDownList(ArrayHelper::map(\common\models\InstitutionMode::find()->All(),
                        'id',
                        'name'), ['autofocus' => true, 'prompt' => '']); ?>
                </div>
                <div class="col-lg">
                    <?= $form->field($model,
                        'institution_type')->dropDownList(ArrayHelper::map(\common\models\InstitutionType::find()->All(),
                        'id',
                        'name'),
                        ['autofocus' => true, 'prompt' => '', !empty($model->institution_type) ? '' : 'disabled'=>'disabled']); ?>
                </div>
            </div>
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
                        ['autofocus' => true, 'multiple' => 'multiple', !empty($model->position) ? '' : 'disabled'=>'disabled']) ?>
                </div>
            </div>
            <?= $form->field($model,
                'education_level')->dropDownList(ArrayHelper::map(\common\models\EducationType::find()->All(), 'id',
                'name'), ['autofocus' => true, 'multiple' => 'multiple']) ?>
            <?= $form->field($model, 'fired_search')->dropdownList(['0'=>'Ei', '1'=>'Jah'], ['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Otsi', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
                <?= Html::a( 'Eksport CSV',
                    'javascript:exportCSV(`' . Yii::$app->getHomeUrl() . 'search/index/export-csv`,`#employee-search`)',
                    ['name' => 'filterClients', 'class' => 'btn btn-secondary float-right']) ?>
            </div>
        </div>
    </div>

</div>
