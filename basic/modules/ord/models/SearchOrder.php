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
            [['service_id'], 'integer'],
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

        $services = $query->select('count(*) as count, services.name'); ///////////////////

        //$this->load($params);

        $statuses = array(
            'pending' => 0,
            'in progress' => 1,
            'completed' => 2,
            'canceled' => 3,
            'error' => 4
        );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if (!$params['update']) {
            $query->filterWhere(['status' => $statuses[$params['status']]]);
        }


        // изменяем запрос добавляя в его фильтрацию
        if ($params['update'] == 'tr') {
            $query->andFilterWhere(['mode' => $this->mode]);
        }

        if ($params['search'] == 'ok') {
            $query->andFilterWhere(['mode' => $this->mode]);
        }

        //var_dump($params);
        return $dataProvider;
    }

}