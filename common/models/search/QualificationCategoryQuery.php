<?php

namespace common\models\search;

/**
 * This is the ActiveQuery class for [[\common\models\QualificationCategory]].
 *
 * @see \common\models\QualificationCategory
 */
class QualificationCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\QualificationCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\QualificationCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
