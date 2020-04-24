<?php

namespace modules\entrant\behaviors;

use dictionary\helpers\DictCompetitiveGroupHelper;
use dictionary\models\DictCompetitiveGroup;
use modules\entrant\models\CseSubjectResult;
use modules\entrant\models\CseViSelect;
use modules\entrant\models\SubmittedDocuments;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use modules\entrant\models\UserCg;
use yii\db\BaseActiveRecord;
use yii\web\User;
use Yii;


class AnketaBehavior extends Behavior
{

    /**
     * @return array
     */

    /**
     * @var BaseActiveRecord
     */
    public $owner;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    public function beforeUpdate($event)
    {
        if ($this->userCseResultExist() && !$this->checkUpdate()) {
            CseSubjectResult::deleteAll($this->userWhere());
        }
        if ($this->userCgExists() && !$this->checkUpdate()) {
            UserCg::deleteAll($this->userWhere());
        }
        if ($this->userViExist() && !$this->checkUpdate()) {
            CseViSelect::deleteAll($this->userWhere());
        }
        if ($this->userSubmittedExists() && !$this->checkUpdate()) {
            SubmittedDocuments::deleteAll($this->userWhere());
        }
    }

    private function userCgExists()
    {
        return UserCg::find()->findUser()->exists();
    }

    private function userCseResultExist()
    {
        return CseSubjectResult::find()->where($this->userWhere())->exists();
    }

    private function userViExist()
    {
        return CseViSelect::find()->where($this->userWhere())->exists();
    }

    private function userSubmittedExists()
    {
        return SubmittedDocuments::find()->where($this->userWhere())->exists();
    }


    private function checkUpdate()
    {
        return $this->owner->oldAttributes == $this->owner->attributes;
    }

    private function userWhere() {
        return ['user_id' => Yii::$app->user->identity->getId()];
    }

}