<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\EducationType]].
 *
 * @see \common\models\EducationType
 */
class EducationTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\EducationType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\EducationType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
