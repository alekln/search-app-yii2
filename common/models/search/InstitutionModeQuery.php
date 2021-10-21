<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\InstitutionMode]].
 *
 * @see \common\models\InstitutionMode
 */
class InstitutionModeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\InstitutionMode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\InstitutionMode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
