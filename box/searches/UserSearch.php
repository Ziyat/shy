<?php

namespace box\searches;

use box\entities\user\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `box\entities\User`.
 * @property User $main
 */
class UserSearch extends User
{
    public $fullName;
    public $main;

    public function __construct($id, $config = [])
    {
        $this->main = User::findOne($id);
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'lft', 'rgt', 'depth'], 'integer'],
            [['username', 'fullName', 'auth_key', 'password_hash', 'password_reset_token', 'role'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     * @throws \yii\base\InvalidArgumentException
     */
    public function search($params)
    {
        $query = $this->main->getDescendants()->orderBy('lft')->with(['rate', 'profile']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->fullName) {
            $query->andFilterWhere(['like', 'profile.surname', $this->fullName]);
            $query->orFilterWhere(['like', 'profile.given_name', $this->fullName]);
            $query->orFilterWhere(['like', 'profile.father_name', $this->fullName]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'role', $this->role]);

        return $dataProvider;
    }
}
