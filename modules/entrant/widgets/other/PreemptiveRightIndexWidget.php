<?php
namespace modules\entrant\widgets\other;

use modules\entrant\models\OtherDocument;
use modules\entrant\models\PreemptiveRight;
use yii\base\Widget;

class PreemptiveRightIndexWidget extends Widget
{
    public $userId;

    public function run()
    {
        $model = PreemptiveRight::find()->joinWith('otherDocument')
            ->where(["user_id" => $this->userId])
            ->select(['user_id', 'type_id'])
            ->groupBy(['user_id', 'type_id'])->all();
        return $this->render('preemptive-right-index', ['model' => $model]);
    }


}
