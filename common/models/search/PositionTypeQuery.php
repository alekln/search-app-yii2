<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\PositionType]].
 *
 * @see \common\models\PositionType
 */
class PositionTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\PositionType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\PositionType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
