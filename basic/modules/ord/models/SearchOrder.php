<?php

namespace app\modules\ord\models;

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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    ['order_id' => SORT_DESC],
                ],
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        //загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['mode' => $this->mode]);

        return $dataProvider;
    }
}