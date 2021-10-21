<?php

namespace frontend\controllers;

use common\models\InstitutionType;
use common\models\Institution;
use common\models\Position;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class CustomDataController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInstitutionType($mode = null)
    {
        $query = InstitutionType::find()->asArray();

        if($mode !== null && !empty($mode)){
            $query->andWhere(['mode'=>$mode]);
        }

        return $this->asJson($query->all());
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionInstitution()
    {
        $data = Yii::$app->request->post();

        $query = Institution::find()->asArray();

        if(isset($data['r']) && ($data['r'] !== null && !empty($data['r']))){
            $query->andWhere(['region_id'=> $data['r']]);
        }

        if(isset($data['p']) && ($data['p'] !== null && !empty($data['p']))){
            $query->andWhere(['province_id'=> $data['p']]);
        }

        if(isset($data['m']) && ($data['m'] !== null && !empty($data['m']))){
            $query->andWhere(['municipality_id'=> $data['m']]);
        }

        if(isset($data['it']) && ($data['it'] !== null && !empty($data['it']))){
            $query->andWhere(['type'=> $data['it']]);
        }
        if(isset($data['im']) && ($data['im'] !== null && !empty($data['im']))){
            $query->andWhere(['category'=> $data['im']]);
        }


        return $this->asJson($query->all());
    }

    public function actionPosition($mode = null)
    {
        $query = Position::find()->asArray();

        if($mode !== null && !empty($mode)){
            $query->andWhere(['type'=> $mode]);
        }
        return $this->asJson($query->all());
    }

}
