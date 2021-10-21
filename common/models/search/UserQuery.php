<?php

namespace common\models\search;

use common\models\User;
use yii\data\ActiveDataProvider;
/**
 * This is the ActiveQuery class for [[\common\models\User]].
 *
 * @see \common\models\User
 */
class UserQuery extends User
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function search($params = [], $pagination = [])
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => (isset($pagination['pageSize']) ? $pagination['pageSize'] :  '10'),
            ],
        ]);

        $dataProvider->setSort([
            'defaultOrder'=>['created_at'=> SORT_DESC],
            'attributes' => [
                'id',

                'created_at',
               /* 'full_name'=>[
                    'asc' => ['client.first_name' => SORT_ASC],
                    'desc' => ['client.first_name' => SORT_DESC],
                    'default' => SORT_DESC
                ],*/
                /*'created_at_range'=>[
                    'asc' => ['client.created_at' => SORT_ASC],
                    'desc' => ['client.created_at' => SORT_DESC],
                    'default' => SORT_DESC
                ],*/

            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        if(isset($this->id) ){
            $query->andFilterWhere(['user.id'=> $this->id]);
        }

        return $dataProvider;
    }
}
