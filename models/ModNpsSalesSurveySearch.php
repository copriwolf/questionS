<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModNpsSalesSurvey;

/**
 * ModNpsSalesSurveySearch represents the model behind the search form about `app\models\ModNpsSalesSurvey`.
 */
class ModNpsSalesSurveySearch extends ModNpsSalesSurvey
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['S1', 'S2', 'S3', 'S4', 'S5', 'A2', 'A3', 'C1', 'C2', 'C3'], 'integer'],
            //[['Name', 'Phone', 'S1Other', 'S2Other', 'A1', 'A31', 'A42A1', 'A42A2', 'A42A3', 'A42A4', 'A42A5', 'A42B1', 'A42B2', 'A42B3', 'A42B4', 'A42B5', 'C3Other'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = ModNpsSalesSurvey::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'S1' => $this->S1,
            'S2' => $this->S2,
            'S3' => $this->S3,
            'S4' => $this->S4,
            'S5' => $this->S5,
            'A2' => $this->A2,
            'A3' => $this->A3,
            'C1' => $this->C1,
            'C2' => $this->C2,
            'C3' => $this->C3,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Phone', $this->Phone])
            ->andFilterWhere(['like', 'S1Other', $this->S1Other])
            ->andFilterWhere(['like', 'S2Other', $this->S2Other])
            ->andFilterWhere(['like', 'A1', $this->A1])
            ->andFilterWhere(['like', 'A31', $this->A31])
            ->andFilterWhere(['like', 'A42A1', $this->A42A1])
            ->andFilterWhere(['like', 'A42A2', $this->A42A2])
            ->andFilterWhere(['like', 'A42A3', $this->A42A3])
            ->andFilterWhere(['like', 'A42A4', $this->A42A4])
            ->andFilterWhere(['like', 'A42A5', $this->A42A5])
            ->andFilterWhere(['like', 'A42B1', $this->A42B1])
            ->andFilterWhere(['like', 'A42B2', $this->A42B2])
            ->andFilterWhere(['like', 'A42B3', $this->A42B3])
            ->andFilterWhere(['like', 'A42B4', $this->A42B4])
            ->andFilterWhere(['like', 'A42B5', $this->A42B5])
            ->andFilterWhere(['like', 'C3Other', $this->C3Other]);

        return $dataProvider;
    }
}
