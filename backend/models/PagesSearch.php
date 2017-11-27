<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pages;

/**
 * PagesSearch represents the model behind the search form about `backend\models\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['title', 'text', 'parent_id', 'lang_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent_id class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('parents');
//        $query->joinWith('lang');

        $query->andFilterWhere([
            'id' => $this->id,
            'pages.type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'pages.title', $this->title])
            // ->andFilterWhere(['like', 'text', $this->text])
//            ->andFilterWhere(['like', 'lang.name', $this->lang_id])
            ->andFilterWhere(['like', 'p.title', $this->parent_id]);

        return $dataProvider;
    }
}
