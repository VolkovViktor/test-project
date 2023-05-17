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
            [['id'], 'integer'],
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
        ]);

        // загружаем данные формы поиска и производим валидацию
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // изменяем запрос добавляя в его фильтрацию
        $query->andFilterWhere(['id' => $this->id]);
        //$query->andFilterWhere(['like', 'title', $this->title])
            //->andFilterWhere(['like', 'creation_date', $this->creation_date]);

        return $dataProvider;
    }
}