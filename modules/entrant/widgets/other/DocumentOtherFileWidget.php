<?php
namespace modules\entrant\widgets\other;

use modules\entrant\models\OtherDocument;
use yii\base\Widget;

class DocumentOtherFileWidget extends Widget
{
    public function run()
    {
        $model = OtherDocument::find()->where(['user_id' => $this->getIdUser()])->all();
        return $this->render('file', [
            'others' => $model
        ]);
    }


    private function getIdUser() {
        return \Yii::$app->user->identity->getId();
    }
}