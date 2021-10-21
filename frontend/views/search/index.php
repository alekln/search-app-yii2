<?php

use yii\bootstrap\Tabs;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col">
                <?=
                Tabs::widget([
                    'class'=>'nav nav-tabs',
                    'id'=>'tabs-container',
                    'items' => [
                        [
                            'label'     => 'Töötajad',
                            'content'   =>  $this->render('tabs/employee', ['dataProvider'=>$dataProvider, 'model'=>$model]),
                            'active'    =>  true,
                            'linkOptions'=> ['class'=>'nav-link active'],
                            'options' => ['id' => 'employee', 'class'=>'nav-item'],

                        ],
                        [
                            'label'     =>  'Õppeasutused',
                            'content'   =>  $this->render('tabs/institutions', ['model'=>'']),
                            'active'    =>  false,
                            'linkOptions'=> ['class'=>'nav-link'],
                            'options' => ['id' => 'institutions', 'class'=>'nav-item'],

                        ],

                        [
                            'label'     =>  'Kasutajad',
                            'content'   =>  $this->render('tabs/users'),
                            'active'    =>  false,
                            'linkOptions'=> ['class'=>'nav-link'],
                            'options' => ['id' => 'users', 'class'=>'nav-item'],

                        ]
                    ]
                ]);
                ?>
            </div>
        </div>

    </div>
</div>
