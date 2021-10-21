<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "address_muncipality".
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 */
class AddressMuncipality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address_muncipality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
        ];
    }
}
