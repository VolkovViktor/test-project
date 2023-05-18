<?php

namespace app\modules\ord\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SearchOrder extends Order
{
    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['mode'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Order::find();
        $query->joinWith('user');
        $query->joinWith('service');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        //$this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['mode' => $this->mode]);

        if ($params['status']=='pending') {
            $query->andFilterWhere(['status' => 0]);
        }
        //var_dump($params);
        return $dataProvider;
    }
}