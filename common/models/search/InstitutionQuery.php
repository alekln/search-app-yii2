<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\Institution]].
 *
 * @see \common\models\Institution
 */
class InstitutionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Institution[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Institution|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
