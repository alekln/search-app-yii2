<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {

        $sql = file_get_contents(__DIR__ . '/sql/schema.sql');
        Yii::$app->db->pdo->exec($sql);
    }

    public function down()
    {
    }
}
