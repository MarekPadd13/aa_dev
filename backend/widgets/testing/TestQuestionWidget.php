<?php
namespace backend\widgets\testing;

use testing\models\TestGroup;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class TestQuestionWidget extends Widget
{
    public $test_id;
    /**
     * @var string
     */
    public $view = 'test-question/index';

    public function run()
    {
        $query = TestGroup::find()->where([ 'test_id'=> $this->test_id]);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        return $this->render($this->view, [
            'dataProvider' => $dataProvider,
        ]);
    }
}
